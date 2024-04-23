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
        $request->validate([
            'name' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'size' => 'required',
            'kapasitas' => 'required',
            'bed' => 'required',
        ]);

        $imageName = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('images/kategori'), $imageName);

        KategoriHotel::create([
            'name' => $request->name,
            'gambar' => $imageName,
            'size' => $request->size,
            'kapasitas' => $request->kapasitas,
            'bed' => $request->bed,
        ]);

        return redirect()->route('kategori-hotel.index')
                         ->with('success','Category added successfully');
    }

    // Mengupdate kategori yang ada
    public function update(Request $request, $id)
    {
        $request->validate([
            'editCategoryName' => 'required',
            'editCategoryImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'editCategorySize' => 'required',
            'editCategoryCapacity' => 'required',
            'editCategoryBed' => 'required',
        ]);

        $category = KategoriHotel::find($id);

        $imageName = time().'.'.$request->editCategoryImage->extension();  
        $request->editCategoryImage->move(public_path('images/kategori'), $imageName);

        $category->name = $request->editCategoryName;
        $category->gambar = $imageName;
        $category->size = $request->editCategorySize;
        $category->kapasitas = $request->editCategoryCapacity;
        $category->bed = $request->editCategoryBed;
        $category->save();

        return redirect()->route('kategori-hotel.index')
                         ->with('success','Category updated successfully');
    }

    // Menghapus kategori
    public function destroy($id)
    {
        KategoriHotel::destroy($id);
        return redirect()->route('kategori-hotel.index')
                         ->with('success','Category deleted successfully');
    }
}
