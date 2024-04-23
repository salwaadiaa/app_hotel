<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row align-items-stretch">
                <!-- Total Bookings -->
                <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4">
                                <i class="material-icons opacity-10">book</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Bookings</p>
                                <h4 class="mb-0">{{ $totalBookings }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Hotels -->
                <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4">
                                <i class="material-icons opacity-10">hotel</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Hotels</p>
                                <h4 class="mb-0">{{ $totalHotels }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Hotel Categories -->
                <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4">
                                <i class="material-icons opacity-10">category</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Hotel Categories</p>
                                <h4 class="mb-0">{{ $totalHotelCategories }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Total Amount from Bookings -->
                <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-danger shadow-danger text-center border-radius-xl mt-n4">
                                <i class="material-icons opacity-10">attach_money</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Total Amount from Bookings</p>
                                <h4 class="mb-0">Rp.{{ number_format($totalHarga, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
