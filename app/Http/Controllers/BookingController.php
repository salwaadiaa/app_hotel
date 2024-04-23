<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\KategoriHotel;
use Dompdf\Dompdf;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('status', 'Check-in')->get();

        $hotels = Hotel::all();
        $categories = KategoriHotel::all();

        return view('dashboard.booking.index', compact('bookings', 'hotels', 'categories'));
    }

    public function indexSelesai(Request $request)
    {

        $query = Booking::where('status', 'Check-out');

        $bookingsSelesai = $query->get();

        $totalHarga = $bookingsSelesai->sum('hotel.harga');

        return view('dashboard.booking.indexSelesai', compact('bookingsSelesai', 'totalHarga'));
    }

    public function exportPDF(Request $request)
    {
        $bookingsSelesai = Booking::where('status', 'Check-out')->get();

        $view = view('dashboard.booking.pdf', compact('bookingsSelesai'))->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->stream('booking_report.pdf');
    }

    public function indexuser()
    {
        $bookings = Booking::all();
        $hotels = Hotel::all();
        $categories = KategoriHotel::all();
        return view('dashboard.booking.indexuser', compact('bookings', 'hotels', 'categories'));
    }

    public function create($hotel_id)
    {
        $hotel = Hotel::find($hotel_id);
        if (!$hotel) {
            return redirect()->back()->with('error', 'Hotel not found.');
        }

        return view('components.booking', compact('hotel'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        $booking = new Booking();
        $booking->user_id = auth()->user()->id; 
        $booking->hotel_id = $request->input('hotel_id'); 
        $booking->check_in = $validatedData['check_in'];
        $booking->check_out = $validatedData['check_out'];
        $booking->guests = $validatedData['guests'];
        $booking->status = 'Check-in';

        $booking->save();

        return redirect()->route('dashboard')->with('success', 'Booking berhasil dibuat!');
    }

    public function finish(Booking $booking)
    {
        if (auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to finish bookings.');
        }

        $hotel = $booking->hotel;

        $booking->status = 'Check-out';
        $booking->save();

        $hotel->totalKamar += 1;
        $hotel->save();

        return redirect()->route('booking.index')->with('success', 'Booking has been marked as finished.');
    }

    public function reschedule(Request $request, Booking $booking)
    {
        $validatedData = $request->validate([
            'new_check_in' => 'required|date',
            'new_check_out' => 'required|date|after:new_check_in',
        ]);

        $booking->check_in = $validatedData['new_check_in'];
        $booking->check_out = $validatedData['new_check_out'];
        $booking->save();

        return redirect()->route('booking.index')->with('success', 'Booking has been rescheduled successfully.');
    }

}
