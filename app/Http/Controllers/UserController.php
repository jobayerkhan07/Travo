<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use App\Models\Property;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $user = "users";

    public function showAuthform()
    {
        return view('user.auth');
    }

    //func to register
    public function store(Request $request)
    {
        $validated= $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email|max:100',
            'phone_number' => 'required|string|size:11|unique:users,phone_number',  // Ensure phone number length is exactly 11 characters
            'password' => 'required|string|min:6',  // You can adjust the minimum length if needed
        ]);
        $user = new User();
        $user->firstname = $validated['firstname'];
        $user->lastname = $validated['lastname'];
        $user->email = $validated['email'];
        $user->phone_number = $validated['phone_number'];
        $user->password = Hash::make($validated['password']);
        $res = $user->save();
        if($res){
            back()->with('success', 'user Registration Successfully!');
        }else{
            back()->with('fail', 'User Registration Failed!');
        }

        return back()->with('success', 'You have successfully registered. Please log in.');
    }


    //func to login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }
        $request->session()->put('user_id', $user->id);
        return redirect('/');
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('showAuthform')->with("success", "You have successfully logged out!");
    }


    public function showRoomsByLocation($location)
    {
        $rooms = Room::where('location', $location)->where('status', 'Approved')->get();
        return view('user.hotelexplore', [
            'rooms' => $rooms,
            'location' => $location
        ]);
    }
    public function showCheckoutForm($type, $id)
    {
        // $type will be 'room' or 'car'
        $bookable = ($type === 'room')
            ? Room::findOrFail($id)
            : Car::findOrFail($id);          // add more elseif() as needed

        // pick the right daily rate field
        $rate = $bookable instanceof Room
            ? $bookable->price_per_night
            : $bookable->price_per_day;

        // default total = one day/night
        $totalPrice = $rate;

        return view('user.checkout', [
            'bookable'    => $bookable,   // one model (Room | Car)
            'rate'        => $rate,       // numeric
            'totalPrice'  => $totalPrice, // numeric
        ]);
    }

    public function room_checkout(Request $request, $id)
    {
        $data = $request->validate([
            'payment_method'  => 'required|in:card,bkash,nagad',
            'card_number'     => 'required_if:payment_method,card|nullable|string',
            'payment_phone'   => 'required_if:payment_method,bkash,nagad|nullable|string|size:11',
            'check_in_time'   => 'required|date',
            'check_out_time'  => 'nullable|date|after_or_equal:check_in_time',
        ]);

        $room = Room::findOrFail($id);

        $checkIn  = Carbon::parse($data['check_in_time']);
        $checkOut = $data['check_out_time']
            ? Carbon::parse($data['check_out_time'])
            : $checkIn->copy()->addDay();
        $nights = max(1, $checkIn->diffInDays($checkOut));

        $order = Order::create([
            'user_id'       => session('user_id'),
            'vendor_id'     => $room->vendor_id,
            'bookable_type' => Room::class,
            'bookable_id'   => $room->id,
            'start_date'    => $checkIn->toDateString(),
            'end_date'      => $checkOut->toDateString(),
            'total_price'   => $room->price_per_night * $nights,
            'status'        => 'Successful',
        ]);

        return redirect()->route('user.thankyou')
            ->with('success', 'Booking placed! Total = '.number_format($order->total_price,2).' BDT');
    }

    private function homepageCars()
    {
        return Car::where('status','approved')
            ->latest()->take(4)->get();
    }

    /** Explore-all page */
    public function showCars()
    {
        $cars = Car::where('status','approved')
            ->latest()->paginate(12);

        return view('user.carexplore', compact('cars'));
    }

    /** Single car detail */
    public function showCar($id)
    {
        $car = Car::where('status','approved')->findOrFail($id);

        return view('user.car-detail', compact('car'));
    }


    public function submitCheckout(Request $request, string $type, int $id)
    {
        /* 1.  Common payment/date validation */
        $data = $request->validate([
            'payment_method'  => 'required|in:card,bkash,nagad',
            'card_number'     => 'required_if:payment_method,card|nullable|string',
            'payment_phone'   => 'required_if:payment_method,bkash,nagad|nullable|string|size:11',
            'check_in_time'   => 'required|date',
            'check_out_time'  => 'nullable|date|after_or_equal:check_in_time',
        ]);

        /* 2.  Resolve which model we’re booking */
        $class = match(strtolower($type)) {
            'room' => Room::class,
            'car'  => Car::class,
            default => abort(404, 'Unknown bookable type')
        };

        /** @var Room|Car $item */
        $item = $class::findOrFail($id);

        /* 3.  Nights / days between the two dates (minimum 1) */
        $checkIn  = Carbon::parse($data['check_in_time']);
        $checkOut = $data['check_out_time']
            ? Carbon::parse($data['check_out_time'])
            : $checkIn->copy()->addDay();
        $units = max(1, $checkIn->diffInDays($checkOut));   // rooms = nights, cars = days

        /* 4.  Pick the correct rate field */
        $rate = $item instanceof Room ? $item->price_per_night : $item->price_per_day;

        /* 5.  Create the order */
        $order = Order::create([
            'user_id'       => session('user_id'),
            'vendor_id'     => $item->vendor_id,
            'bookable_type' => $class,          // morph fields
            'bookable_id'   => $item->id,

            'start_date'    => $checkIn->toDateString(),
            'end_date'      => $checkOut->toDateString(),
            'total_price'   => $rate * $units,

            'status'        => 'successful',
        ]);

        return redirect()
            ->route('user.thankyou')
            ->with('success', 'Booking placed! Total = '.number_format($order->total_price,2).' BDT');
    }

    public function landing()
    {
        /* 4 newest approved cars for the homepage band */
        $cars = Car::where('status', 'approved')
            ->latest()
            ->take(4)
            ->get();

        return view('user.mainlanding', compact('cars'));
    }



}
