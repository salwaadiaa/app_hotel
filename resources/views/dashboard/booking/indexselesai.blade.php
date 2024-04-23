<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <!-- Tabel booking selesai -->
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                                <h6 class="text-white text-capitalize ps-3 mb-0">Booking Hotel Selesai</h6>
                                <div class="ms-auto me-3 d-flex align-items-center">
                                    <div class="me-2">
                                    <div>
                                        <a href="{{ route('booking.exportPdf') }}" class="btn btn-sm btn-white me-2">
                                            <i class="fas fa-file-pdf me-1"></i> Export PDF
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <!-- Tabel header -->
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pemesan</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Handphone</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hotel</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Check-in</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Check-out</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Guests</th>
                                        </tr>
                                    </thead>
                                    <!-- Isi tabel -->
                                    <tbody style="text-align: center;">
                                        @foreach($bookingsSelesai as $index => $booking)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $booking->user->name }}</td>
                                                <td>{{ $booking->user->phone }}</td>
                                                <td>{{ $booking->hotel->nama }}</td>
                                                <td>Rp. {{ number_format($booking->hotel->harga, 0, ',', '.') }}</td>
                                                <td>{{ $booking->check_in }}</td>
                                                <td>{{ $booking->check_out }}</td>
                                                <td>{{ $booking->guests }}</td>
                                            </tr>
                                        @endforeach
                                        <!-- Total Harga -->
                                        <tr>
                                            <td colspan="4" class="text-end font-weight-bold">Total Harga:</td>
                                            <td colspan="4" class="text-start font-weight-bold">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>
    <x-footers.auth></x-footers.auth>
</x-layout>

<script>
    document.getElementById('filter').addEventListener('change', function() {
        var filterValue = this.value;
        if (filterValue === 'semua') {
            window.location.href = "{{ route('booking.indexselesai') }}";
        } else {
            window.location.href = "{{ route('booking.indexselesai') }}?filter=" + filterValue;
        }
    });
</script>
