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
                                <h6 class="text-white text-capitalize ps-3 mb-0">Categories table</h6>
                                <div class="ms-auto me-3">
                                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add New Category</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category Name</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gambar</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Size</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kapasitas</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bed</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align: center;">
                                        <!-- Data rows will be populated here -->
                                        @foreach($categories as $index => $category)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <img src="{{ asset('images/kategori/' . $category->gambar) }}" alt="Category Image" style="max-width: 100px;">
                                            </td>
                                            <td>{{ $category->size }}</td>
                                            <td>{{ $category->kapasitas }}</td>
                                            <td>{{ $category->bed }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">Edit</button>
                                                    <form id="deleteForm{{ $category->id }}" action="{{ route('kategori-hotel.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $category->id }})">Delete</button>
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
        <!-- Modal for adding new category -->
            <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for adding new category goes here -->
                            <form action="{{ route('kategori-hotel.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="categoryName" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="categoryImage" class="form-label">Category Image</label>
                                    <input type="file" class="form-control" id="categoryImage" name="gambar" required>
                                </div>
                                <div class="mb-3">
                                    <label for="categorySize" class="form-label">Size</label>
                                    <input type="text" class="form-control" id="categorySize" name="size" required>
                                </div>
                                <div class="mb-3">
                                    <label for="categoryCapacity" class="form-label">Capacity</label>
                                    <input type="text" class="form-control" id="categoryCapacity" name="kapasitas" required>
                                </div>
                                <div class="mb-3">
                                    <label for="categoryBed" class="form-label">Bed</label>
                                    <input type="text" class="form-control" id="categoryBed" name="bed" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->

            <!-- Modal for editing category -->
            @foreach($categories as $category)
            <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form for editing category goes here -->
                            <form action="{{ route('kategori-hotel.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="editCategoryName{{ $category->id }}" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="editCategoryName{{ $category->id }}" name="editCategoryName" value="{{ $category->name }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editCategoryImage{{ $category->id }}" class="form-label">Category Image</label>
                                    <input type="file" class="form-control" id="editCategoryImage{{ $category->id }}" name="editCategoryImage" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editCategorySize{{ $category->id }}" class="form-label">Size</label>
                                    <input type="text" class="form-control" id="editCategorySize{{ $category->id }}" name="editCategorySize" value="{{ $category->size }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editCategoryCapacity{{ $category->id }}" class="form-label">Capacity</label>
                                    <input type="text" class="form-control" id="editCategoryCapacity{{ $category->id }}" name="editCategoryCapacity" value="{{ $category->kapasitas }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editCategoryBed{{ $category->id }}" class="form-label">Bed</label>
                                    <input type="text" class="form-control" id="editCategoryBed{{ $category->id }}" name="editCategoryBed" value="{{ $category->bed }}" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Add JavaScript function for SweetAlert confirmation -->
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this category!',
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
