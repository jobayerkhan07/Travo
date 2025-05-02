<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Property;
use App\Models\Car;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class VendorController extends Controller
{
    // ------------------- Login & Register -------------------

    public function showRegisterForm()
    {
        return view('vendor.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'email' => 'required|email|unique:vendors,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:6|confirmed',
            'service' => 'required|string'
        ]);

        Vendor::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'service' => $request->service,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('vendor.showLogin')->with('success', 'Registration successful! Please login.');
    }

    public function showLoginForm()
    {
        return view('vendor.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $vendor = Vendor::where('email', $request->email)->first();

        if ($vendor && Hash::check($request->password, $vendor->password)) {
            session()->put('vendor_id', $vendor->id);
            return redirect()->route('vendor.main');
        }

        return back()->withErrors(['fail' => 'Invalid email or password.']);
    }

    public function logout()
    {
        session()->forget('vendor_id');
        return redirect()->route('vendor.showLogin');
    }

    // ------------------- Main Vendor Dashboard -------------------

    public function showMain()
    {
        return view('vendor.mainven');
    }

    // ------------------- Property Management -------------------

    public function showAddProperty()
    {
        return view('vendor.addProperty');
    }

    public function storeProperty(Request $request)
    {
        $validated = $request->validate([
            'property_name'    => 'required|string|max:100',
            'property_type'    => 'required|string|max:100',
            'location'         => 'required|string|max:255',
            'address'          => 'required|string',
            'description'      => 'required|string',
            'guests'           => 'required|integer|min:1',
            'bathrooms'        => 'required|integer|min:1',
            'price_per_day'    => 'required|numeric|min:0',
            'children_allowed' => 'required|boolean',
            'children_no'      => 'required|integer|min:0',
            'pets_allowed'     => 'required|boolean',
            'pets_no'          => 'required|integer|min:0',
            'room_size'        => 'required|string',
            'images'           => 'required|array',
            'images.*'         => 'image|max:2048',
            'check_in_time'    => 'required|string',
            'check_out_time'   => 'required|string',
        ]);

        $paths = [];
        foreach ($request->file('images') as $file) {
            $paths[] = $file->store('properties', 'public');
        }

        $validated['images']    = $paths;
        $validated['vendor_id'] = session('vendor_id');
        $validated['status']    = 'pending';

        $property = Property::create($validated);

        session(['item_type' => 'property', 'item_id' => $property->id]);

        return redirect()->route('vendor.itemDetail', ['type' => 'property', 'id' => $property->id])
            ->with('success', 'Property Added Successfully!');
    }

    // ------------------- Car Management -------------------

    public function showCars()
    {
        return view('vendor.cars');
    }

    public function storeCar(Request $request)
    {
        $validated = $request->validate([
            'owner_name'        => 'required|string|max:255',
            'owner_phone'       => 'required|string|max:20',
            'owner_email'       => 'required|email|max:255',
            'car_model'         => 'required|string|max:255',
            'capacity'          => 'required|integer|min:1',
            'car_color'         => 'nullable|string|max:100',
            'plate_number'      => 'required|string|max:100',
            'air_conditioning'  => 'required|boolean',
            'price_per_day'     => 'required|numeric|min:0',
            'price_per_week'    => 'required|numeric|min:0',
            'images'            => 'required',
            'images.*'          => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('cars', 'public');
            }
        }

        Car::create([
            'vendor_id'         => session('vendor_id'), // Vendor session ID
            'owner_name'        => $validated['owner_name'],
            'owner_phone'       => $validated['owner_phone'],
            'owner_email'       => $validated['owner_email'],
            'car_model'         => $validated['car_model'],
            'capacity'          => $validated['capacity'],
            'car_color'         => $validated['car_color'] ?? null,
            'plate_number'      => $validated['plate_number'],
            'air_conditioning'  => $validated['air_conditioning'],
            'images'            => $imagePaths,
            'price_per_day'     => $validated['price_per_day'],
            'price_per_week'    => $validated['price_per_week'],
            'status'            => 'pending'
        ]);

        return redirect()->route('vendor.main')->with('success', 'Car added successfully!');
    }

    // ------------------- Room Management -------------------

    public function showRooms()
    {
        return view('vendor.rooms');
    }

    public function storeRoom(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:255',
            'floor_number' => 'required|integer',
            'room_size' => 'required|integer',
            'room_type' => 'required|string|max:255',
            'num_beds' => 'required|integer',
            'max_capacity' => 'required|integer',
            'air_conditioning' => 'required|boolean',
            'wifi' => 'required|boolean',
            'balcony' => 'required|boolean',
            'price_per_night' => 'required|numeric',
            'extra_guest_price' => 'nullable|numeric',
            'available_from' => 'required|date',
            'available_to' => 'required|date',
            'room_images' => 'nullable',
            'location' => 'required|string|max:255',
            'property_name' => 'required|string|max:255',
        ]);

        $validated['vendor_id'] = session('vendor_id');
        $validated['status'] = 'pending';

        // Handle room images
        if ($request->hasFile('room_images')) {
            $imagePaths = [];

            foreach ($request->file('room_images') as $file) {
                $path = $file->store('rooms', 'public');
                $imagePaths[] = $path;
            }

            // Save as JSON
            $validated['room_images'] = json_encode($imagePaths);
        } else {
            $validated['room_images'] = json_encode([]);
        }

        $room = Room::create($validated);

        session(['item_type' => 'room', 'item_id' => $room->id]);

        return redirect()->route('vendor.itemDetail', ['type' => 'room', 'id' => $room->id])
            ->with('success', 'Room Added Successfully!');
    }

    // ------------------- Overview Pages -------------------

    public function showOverview()
    {
        $vendorId = session('vendor_id');

        $properties = Property::where('vendor_id', $vendorId)->latest()->get();
        $cars       = Car::where('vendor_id', $vendorId)->latest()->get();
        $rooms      = Room::where('vendor_id', $vendorId)->latest()->get();

        return view('vendor.overview-cards', compact('properties', 'cars', 'rooms'));
    }

    public function itemDetail($type, $id)
    {
        if ($type === 'property') {
            $item = Property::findOrFail($id);
        } elseif ($type === 'car') {
            $item = Car::findOrFail($id);
        } elseif ($type === 'room') {
            $item = Room::findOrFail($id);
        } else {
            abort(404);
        }

        return view('vendor.item-detail', compact('item', 'type'));
    }





}
