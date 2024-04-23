<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Booking;
use App\Models\KategoriHotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::all();
        $categories = KategoriHotel::all();
        return view('dashboard.hotel.index', compact('hotels', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'namaHotel' => 'required|string|max:255',
            'kategoriHotel' => 'required|exists:kategori_hotels,id',
            'gambarHotel' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'fasilitasHotel' => 'required|string',
            'deskripsiHotel' => 'required|string',
            'hargaHotel' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'totalKamar' => 'required|integer',
        ]);

        $imageName = time().'.'.$request->gambarHotel->extension();  
        $request->gambarHotel->move(public_path('images/hotels'), $imageName);

        Hotel::create([
            'nama' => $request->namaHotel,
            'category_id' => $request->kategoriHotel,
            'gambar' => $imageName,
            'fasilitas' => $request->fasilitasHotel,
            'deskripsi' => $request->deskripsiHotel,
            'harga' => $request->hargaHotel,
            'totalKamar' => $request->totalKamar,
        ]);

        return redirect()->route('hotel.index')->with('success', 'Hotel berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'editNamaHotel' => 'required|string|max:255',
            'editKategoriHotel' => 'required|exists:kategori_hotels,id',
            'editGambarHotel' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // max 2MB
            'editFasilitasHotel' => 'required|string',
            'editDeskripsiHotel' => 'required|string',
            'editHargaHotel' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'editTotalKamar' => 'required|integer',
        ]);

        if ($request->hasFile('editGambarHotel')) {
            $imageName = time().'.'.$request->editGambarHotel->extension();  
            $request->editGambarHotel->move(public_path('images/hotels'), $imageName);
            $hotel->gambar = $imageName;
        }

        $hotel->nama = $request->editNamaHotel;
        $hotel->category_id = $request->editKategoriHotel;
        $hotel->fasilitas = $request->editFasilitasHotel;
        $hotel->deskripsi = $request->editDeskripsiHotel;
        $hotel->harga = $request->editHargaHotel;
        $hotel->totalKamar = $request->editTotalKamar;
        $hotel->save();

        return redirect()->route('hotel.index')->with('success', 'Hotel berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return redirect()->route('hotel.index')->with('success', 'Hotel berhasil dihapus.');
    }


    
}
