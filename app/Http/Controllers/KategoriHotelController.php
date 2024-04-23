<?php

namespace App\Http\Controllers;

use App\Models\KategoriHotel;
use Illuminate\Http\Request;

class KategoriHotelController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        $categories = KategoriHotel::all();
        return view('dashboard.kategori_hotel.index', compact('categories'));
    }


    /**
     * Menyimpan kategori baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:kategori_hotels',
        ]);
    
        // Buat kategori baru dan simpan ke database
        KategoriHotel::create([
            'name' => $validatedData['name'],
        ]);
    
        return redirect()->route('kategori-hotel.index')->with('success', 'Kategori Hotel berhasil ditambahkan');
    }

    /**
     * Memperbarui kategori yang ada di penyimpanan.
     */
    public function update(Request $request, KategoriHotel $kategoriHotel)
    {
        $validatedData = $request->validate([
            'editCategoryName' => 'required|unique:kategori_hotels,name,'.$kategoriHotel->id,
        ]);

        $kategoriHotel->update(['name' => $validatedData['editCategoryName']]);

        return redirect()->route('kategori-hotel.index')->with('success', 'Kategori Hotel berhasil diperbarui');
    }

    /**
     * Menghapus kategori dari penyimpanan.
     */
    public function destroy(KategoriHotel $kategoriHotel)
    {
        $kategoriHotel->delete();

        return redirect()->route('kategori-hotel.index')->with('success', 'Kategori Hotel berhasil dihapus');
    }
}
