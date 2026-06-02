<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('orders.index');
    }

    public function userOrders()
    {
        $orders = Order::with('place')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function adminDashboard()
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $orders = Order::with(['user', 'place'])->latest()->get();

        return view('admin.dashboard', compact('orders'));
    }

    public function approve(Order $order): RedirectResponse
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }

        $order->update(['status' => 'approved']);

        return back()->with('success', 'Pesanan berhasil di-ACC.');
    }
}
