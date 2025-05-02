<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Car;
use App\Models\Order;
use App\Models\Property;
use App\Models\Room;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\password;

class AdminAuthController extends Controller
{

    public function showLoginForm()
    {
        return view('admin.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', '=', $request->username)->first();


        if ($admin && Hash::check($request->password, $admin->password)) {
            $request->session()->put('admin_id', $admin->id);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['fail' => 'Invalid Username!']);
    }


    public function dashboard()
    {
        $data = array();
        if(session()->has('admin_id')) {
            $data = Admin::where('id', '=' , session()->get('admin_id'))->first();

            /* ──────────────────────────────
         | 1. LIVE COUNTS (KPI cards)
         ──────────────────────────────*/
            $totalBookings  = Order::count();
            $totalCustomers = User::count();
            $totalVendors   = Vendor::count();
            $totalAdmins    = Admin::count();
            $totalRevenue   = Order::sum('total_price') * 0.30;     // admin share

            /* ──────────────────────────────
             | 2. LAST-MONTH COUNTS → deltas
             ──────────────────────────────*/
            $prev = static function ($model) {
                [$from, $to] = [
                    Carbon::now()->subMonth()->startOfMonth(),
                    Carbon::now()->subMonth()->endOfMonth(),
                ];
                return $model::whereBetween('created_at', [$from, $to])->count();
            };

            $prevBookings  = $prev(Order::class);
            $prevCustomers = $prev(User::class);
            $prevVendors   = $prev(Vendor::class);
            $prevAdmins    = $prev(Admin::class);
            $prevRevenue   = Order::whereBetween('created_at', [
                    Carbon::now()->subMonth()->startOfMonth(),
                    Carbon::now()->subMonth()->endOfMonth(),
                ])->sum('total_price') * 0.30;

            $delta = fn ($now, $prev) => $prev ? round( ( ($now - $prev)/$prev)*100 ,1) : 100;

            /* ──────────────────────────────
             | 3. CHART A – bookings last 6 months
             ──────────────────────────────*/
            $months=[]; $bookingData=[];
            for ($i=5;$i>=0;$i--){
                $point = Carbon::now()->subMonths($i);
                $months[] = $point->format('M');
                $bookingData[] = Order::whereYear('created_at',$point->year)
                    ->whereMonth('created_at',$point->month)
                    ->count();
            }

            /* ──────────────────────────────
             | 4. CHART B – revenue split
             ──────────────────────────────*/
            $adminShare  = round($totalRevenue,2);
            $vendorShare = round($adminShare * (70/30),2);       // 70 % of total

            /* ──────────────────────────────
             | 5. CHART C – “users” by role (3 separate tables)
             ──────────────────────────────*/
            $roles = collect([
                'Customers' => $totalCustomers,
                'Vendors'   => $totalVendors,
                'Admins'    => $totalAdmins,
            ]);

            /* ──────────────────────────────
             | 6. PUSH TO VIEW
             ──────────────────────────────*/
            return view('admin.dashboard', [
                // KPI counts
                'totalBookings'  => $totalBookings,
                'totalUsers' => $totalCustomers,
                'totalVendors'   => $totalVendors,
                'totalAdmins'    => $totalAdmins,
                'totalRevenue'   => $totalRevenue,

                // deltas
                'dBookings'  => $delta($totalBookings,  $prevBookings),
                'dUsers' => $delta($totalCustomers, $prevCustomers),
                'dVendors'   => $delta($totalVendors,   $prevVendors),
                'dAdmins'    => $delta($totalAdmins,    $prevAdmins),
                'dRevenue'   => $delta($totalRevenue,   $prevRevenue),

                // chart A
                'months'      => $months,
                'bookingData' => $bookingData,

                // chart B
                'adminShare'  => $adminShare,
                'vendorShare' => $vendorShare,

                // chart C
                'roles'       => $roles,
                'data'        => $data
            ]);
        }
    }

    public function users()
    {
        if(session()->has('admin_id')) {
            $data = Admin::where('id', '=' , session()->get('admin_id'))->first();
            $users = User::latest()->paginate(15);

            return view('admin.users', compact('users', 'data'));
        }
    }

    public function listing()
    {
        $properties = Property::with('vendor')->get();
        $cars = Car::orderBy('created_at', 'desc')->get();
        $rooms = Room::with('vendor')->latest()->get();
        if(session()->has('admin_id')) {
            $data = Admin::where('id', '=' , session()->get('admin_id'))->first();
            return view('admin.listing', compact('properties', 'data', 'cars', 'rooms'));
        }

    }

     public function vendors()
    {
        $hotelVendors = Vendor::whereIn('service', ['hotel', 'both'])->paginate(10, ['*'], 'hotel-page');
        $carVendors = Vendor::whereIn('service', ['car', 'both'])->paginate(10, ['*'], 'car-page');

        if(session()->has('admin_id')) {
            $data = Admin::where('id', '=' , session()->get('admin_id'))->first();
            return view('admin.vendors', compact('hotelVendors', 'carVendors', 'data'    ));
        }
    }

    public function payments()
    {
        if(session()->has('admin_id')) {
            $data = Admin::where('id', '=' , session()->get('admin_id'))->first();
            $orders = Order::with(['user','vendor','bookable'])
                ->latest()
                ->paginate(20);              // tweak page size

            return view('admin.payments', compact('orders', 'data'));
        }


    }

    // public function reports()
    // {
    //     if(session()->has('admin_id')) {
    //         $data = Admin::where('id', '=' , session()->get('admin_id'))->first();
    //         return view('admin.reports',compact('data'));
    //     }
    // }

    public function logout()
    {
        if(session()->has('admin_id')) {
            session()->pull('admin_id');
            return redirect()->route('admin.login');
        }
    }




    public function approveProperty($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 'Approved';
        $property->save();

        return back()->with('success', 'Property Approved Successfully!');
    }

    public function rejectProperty($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 'Rejected';
        $property->save();

        return back()->with('success', 'Property Rejected Successfully!');
    }

    public function viewProperty($id)
    {
        $property = Property::with('vendor')->findOrFail($id);

        if(session()->has('admin_id')) {
            $data = Admin::where('id', '=' , session()->get('admin_id'))->first();
            return view('admin.view-property', compact('property', 'data'));
        }

    }

    public function vendorListings(Vendor $vendor)
    {
        $properties = Property::where('vendor_id', $vendor->id)->get();
        $rooms = Room::where('vendor_id', $vendor->id)->get();
        $cars = Car::where ('vendor_id', $vendor->id)->get();

        if(session()->has('admin_id')) {
            $data = Admin::where('id', '=' , session()->get('admin_id'))->first();
            return view('admin.listing', compact('vendor', 'properties', 'data', 'cars', 'rooms'));
        }
    }

    public function approveVendor(Vendor $vendor)
    {
        $vendor->status = 'active';
        $vendor->save();
        return back()->with('success', 'Vendor approved successfully.');
    }

    public function deleteVendor(Vendor $vendor)
    {
        // First delete all properties and images
        $properties = Property::where('vendor_id', $vendor->id)->get();

        foreach ($properties as $property) {
            if (is_array($property->images)) {
                foreach ($property->images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            $property->delete();
        }
        $vendor->delete();

        return back()->with('success', 'Vendor and all related listings deleted successfully.');
    }

    public function viewCar($id)
    {
        $car = Car::findOrFail($id);
        if(session()->has('admin_id')) {
            $data = Admin::where('id', '=' , session()->get('admin_id'))->first();
            return view('admin.view-car', compact('car', 'data'));
        }

    }

    public function approveCar($id)
    {
        $car = Car::findOrFail($id);
        $car->status = 'approved';
        $car->save();

        return redirect()->back()->with('success', 'Car approved successfully.');
    }

    public function rejectCar($id)
    {
        $car = Car::findOrFail($id);
        $car->status = 'rejected';
        $car->save();

        return redirect()->back()->with('success', 'Car rejected successfully.');
    }


    public function approveRoom($id)
    {
        Room::where('id', $id)->update(['status' => 'Approved']);
        return back()->with('success', 'Room Approved Successfully!');
    }

    public function rejectRoom($id)
    {
        Room::where('id', $id)->update(['status' => 'Rejected']);
        return back()->with('success', 'Room Rejected!');
    }

    public function viewRoom($id)
    {
        $room = Room::findOrFail($id);

        if(session()->has('admin_id')) {
            $data = Admin::where('id', '=' , session()->get('admin_id'))->first();
            return view('admin.view-room', compact('room', 'data'));
        }

    }

}
