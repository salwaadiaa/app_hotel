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
                                <h6 class="text-white text-capitalize ps-3 mb-0">Hotel Table</h6>
                                <div class="ms-auto me-3">
                                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#addHotelModal">Tambah Hotel</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Hotel</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kategori</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gambar</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fasilitas</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Deskripsi</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah Kamar</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
                                        <!-- Data rows will be populated here -->
                                        @foreach($hotels as $index => $hotel)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $hotel->nama }}</td>
                                                <td>{{ $hotel->KategoriHotel->name }}</td>
                                                <td><img src="{{ asset('images/hotels/' . $hotel->gambar) }}" alt="Hotel Image" style="max-width: 100px;"></td>
                                                <td>Rp. {{ number_format($hotel->harga, 0, ',', '.') }}</td>
                                                <td>{{ $hotel->fasilitas }}</td>
                                                <td>{{ $hotel->deskripsi }}</td>
                                                <td>{{ $hotel->totalKamar }}</td>
                                                <td class="align-middle">
                                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editHotelModal{{ $hotel->id }}">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $hotel->id }})">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                    <form id="deleteForm{{ $hotel->id }}" action="{{ route('hotels.destroy', $hotel->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
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
        <!-- Modal Tambah Hotel -->
        <div class="modal fade" id="addHotelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Hotel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for adding new hotel goes here -->
                        <form id="addHotelForm" method="POST" action="{{ route('hotels.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="namaHotel" class="form-label">Nama Hotel</label>
                                <input type="text" class="form-control" id="namaHotel" name="namaHotel" required>
                            </div>
                            <div class="mb-3">
                                <label for="kategoriHotel" class="form-label">Kategori Hotel</label>
                                <select class="form-select" id="kategoriHotel" name="kategoriHotel" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="gambarHotel" class="form-label">Gambar Hotel</label>
                                <input type="file" class="form-control" id="gambarHotel" name="gambarHotel" required>
                            </div>
                            <div class="mb-3">
                                <label for="hargaHotel" class="form-label">Harga Hotel</label>
                                <input type="number" class="form-control" id="hargaHotel" name="hargaHotel" required>
                            </div>
                            <div class="mb-3">
                                <label for="fasilitasHotel" class="form-label">Fasilitas Hotel</label>
                                <textarea class="form-control" id="fasilitasHotel" name="fasilitasHotel" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsiHotel" class="form-label">Deskripsi Hotel</label>
                                <textarea class="form-control" id="deskripsiHotel" name="deskripsiHotel" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="totalKamar" class="form-label">Jumlah Kamar Hotel</label>
                                <input type="number" class="form-control" id="totalKamar" name="totalKamar" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Hotel -->
        @foreach ($hotels as $hotel)
        <div class="modal fade" id="editHotelModal{{ $hotel->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Hotel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editHotelForm{{ $hotel->id }}" method="POST" action="{{ route('hotels.update', $hotel->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="editNamaHotel{{ $hotel->id }}" class="form-label">Nama Hotel</label>
                                <input type="text" class="form-control" id="editNamaHotel{{ $hotel->id }}" name="editNamaHotel" value="{{ $hotel->nama }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editKategoriHotel{{ $hotel->id }}" class="form-label">Kategori Hotel</label>
                                <select class="form-select" id="editKategoriHotel{{ $hotel->id }}" name="editKategoriHotel" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $hotel->kategori_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editGambarHotel{{ $hotel->id }}" class="form-label">Gambar Hotel</label>
                                <input type="file" class="form-control" id="editGambarHotel{{ $hotel->id }}" name="editGambarHotel">
                                <img src="{{ asset('images/hotels/' . $hotel->gambar) }}" alt="Current Image" style="max-width: 100px;">
                            </div>
                            <div class="mb-3">
                                <label for="editHargaHotel{{ $hotel->id }}" class="form-label">Harga Hotel</label>
                                <input type="number" class="form-control" id="editHargaHotel{{ $hotel->id }}" name="editHargaHotel" value="{{ $hotel->harga }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="editFasilitasHotel{{ $hotel->id }}" class="form-label">Fasilitas Hotel</label>
                                <textarea class="form-control" id="editFasilitasHotel{{ $hotel->id }}" name="editFasilitasHotel" rows="3" required>{{ $hotel->fasilitas }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editDeskripsiHotel{{ $hotel->id }}" class="form-label">Deskripsi Hotel</label>
                                <textarea class="form-control" id="editDeskripsiHotel{{ $hotel->id }}" name="editDeskripsiHotel" rows="3" required>{{ $hotel->deskripsi }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editTotalKamar{{ $hotel->id }}" class="form-label">Jumlah Kamar Hotel</label>
                                <input type="number" class="form-control" id="editTotalKamar{{ $hotel->id }}" name="editTotalKamar" value="{{ $hotel->totalKamar }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </main>
    <x-footers.auth></x-footers.auth>
</x-layout>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Add JavaScript function for SweetAlert confirmation -->
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this hotel!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>