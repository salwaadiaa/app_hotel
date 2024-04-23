<?php

use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\KategoriHotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\KategoriHotel;

Route::get('/', function () {return redirect('landing');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::get('landing', [SessionsController::class, 'landing'])->middleware('guest')->name('landing');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');

Route::get('/kategori-hotels', [KategoriHotelController::class, 'index'])->name('kategori-hotel.index');
Route::post('/kategori-hotels', [KategoriHotelController::class, 'store'])->name('kategori-hotel.store');
Route::put('/kategori-hotels/{kategoriHotel}', [KategoriHotelController::class, 'update'])->name('kategori-hotel.update');
Route::delete('/kategori-hotels/{kategoriHotel}', [KategoriHotelController::class, 'destroy'])->name('kategori-hotel.destroy');

Route::get('/hotels', [HotelController::class, 'index'])->name('hotel.index');
Route::post('/hotels', [HotelController::class, 'store'])->name('hotels.store');
Route::put('/hotels/{hotel}', [HotelController::class, 'update'])->name('hotels.update');
Route::delete('/hotels/{hotel}', [HotelController::class, 'destroy'])->name('hotels.destroy');

Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/selesai', [BookingController::class, 'indexSelesai'])->name('booking.indexselesai');
Route::get('/user/booking', [BookingController::class, 'indexuser'])->name('transaksi.user');
Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
Route::put('/booking/{booking}', [BookingController::class, 'update'])->name('bookings.update');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/create/{hotel_id}', [BookingController::class, 'create'])->name('booking.create');
Route::post('bookings/{booking}/finish', [BookingController::class, 'finish'])->name('booking.finish');
Route::get('booking/export-pdf', [BookingController::class, 'exportPDF'])->name('booking.exportPdf');
Route::post('booking/{booking}/reschedule', [BookingController::class, 'reschedule'])->name('booking.reschedule');

Route::get('/rooms', [DashboardController::class, 'landingHotel'])->name('rooms');

Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});