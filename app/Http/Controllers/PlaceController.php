<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\TouristPlace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    public function landing()
    {
        $places = TouristPlace::all();

        return view('home', compact('places'));
    }

    public function index()
    {
        $places = TouristPlace::all();

        return view('places.index', compact('places'));
    }

    public function show(TouristPlace $place)
    {
        return view('places.show', compact('place'));
    }

    public function order(Request $request, TouristPlace $place)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $existing = Order::where('user_id', Auth::id())
            ->where('tourist_place_id', $place->id)
            ->first();

        if ($existing) {
            return back()->with('message', 'Anda sudah memesan tempat wisata ini.');
        }

        Order::create([
            'user_id' => Auth::id(),
            'tourist_place_id' => $place->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Pesanan berhasil dibuat. Tunggu konfirmasi admin.');
    }
}
