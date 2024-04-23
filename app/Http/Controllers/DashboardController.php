<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriHotel;
use App\Models\Hotel;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                $totalBookings = Booking::count();
                $totalHotels = Hotel::count();
                $totalHotelCategories = KategoriHotel::count();
                $totalHarga = Booking::where('status', 'Check-out')
                ->join('hotels', 'bookings.hotel_id', '=', 'hotels.id')
                ->sum('hotels.harga');
                return view('dashboard.index', compact('totalBookings', 'totalHotels', 'totalHotelCategories', 'totalHarga'));
            }
            elseif (Auth::user()->role === 'user') {
                $categories = KategoriHotel::take(4)->get();
                return view('components.landing', compact('categories'));
            }
        }

        return redirect()->route('login');
    }

    public function landingHotel()
    {
        $hotels = Hotel::where('totalKamar', '>', 0)->get();
        return view('components.hotel', compact('hotels'));
    }
}
