<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3 d-flex justify-content-between align-items-center">
                                <h6 class="text-white text-capitalize ps-3 mb-0">Booking Hotel</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
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
                                            @if (Auth::user()->role == 'admin')
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
                                        <!-- Data rows will be populated here -->
                                        @foreach($bookings as $index => $booking)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $booking->user->name }}</td>
                                                <td>{{ $booking->user->phone }}</td>
                                                <td>{{ $booking->hotel->nama }}</td>
                                                <td>Rp. {{ number_format($booking->hotel->harga, 0, ',', '.') }}</td>
                                                <td>{{ $booking->check_in }}</td>
                                                <td>{{ $booking->check_out }}</td>
                                                <td>{{ $booking->guests }}</td>
                                                @if (Auth::user()->role == 'admin')
                                                <td class="align-middle">
                                                    @if($booking->status == 'Check-in')
                                                        <form action="{{ route('booking.finish', $booking->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Selesai</button>
                                                        </form>
                                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#rescheduleModal{{ $booking->id }}">
                                                            <i class="fas fa-calendar"></i> Reschedule
                                                        </button>
                                                    @endif
                                                </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($bookings as $index => $booking)
    <!-- Modal reschedule untuk setiap booking -->
    <div class="modal fade" id="rescheduleModal{{ $booking->id }}" tabindex="-1" role="dialog" aria-labelledby="rescheduleModalLabel{{ $booking->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rescheduleModalLabel{{ $booking->id }}">Reschedule Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('booking.reschedule', $booking->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="newCheckIn{{ $booking->id }}" class="form-label">New Check-in Date</label>
                            <input type="date" class="form-control" id="newCheckIn{{ $booking->id }}" name="new_check_in" required>
                        </div>
                        <div class="mb-3">
                            <label for="newCheckOut{{ $booking->id }}" class="form-label">New Check-out Date</label>
                            <input type="date" class="form-control" id="newCheckOut{{ $booking->id }}" name="new_check_out" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Reschedule</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


    </main>
    <x-footers.auth></x-footers.auth>
</x-layout>
