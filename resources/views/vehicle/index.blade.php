<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container-fluid flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-xl">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="text-primary">Daftar Vehicles</h4>
                            <button class="btn btn-secondary btn-primary" data-bs-toggle="modal"
                                data-bs-target="#add_new_vehicles" type="button"><span><i
                                        class="bx bx-plus bx-sm me-sm-2"></i>
                                    <span class="d-none d-sm-inline-block">Tambah Vehicles Baru</span></span></button>
                        </div>
                    </div>
                    <div class="card-body">

                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}

                        <table id="example" class="table table-striped border-top"" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Merk</th>
                                    <th>Tipe</th>
                                    <th>Plat Nomor</th>
                                    <th>Status</th>
                                    <th>Driver</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($vehicle as $v)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ ucwords($v->merk) }}</td>
                                        <td>{{ ucwords($v->type) }}</td>
                                        <td>{{ strtoupper($v->vehicle_number) }}</td>
                                        <td>
                                            <span
                                                class="badge rounded-pill {{ strtolower($v->status) == 'available' ? 'bg-label-success' : (strtolower($v->status) == 'maintenance' ? 'bg-label-danger' : 'bg-label-warning') }}">
                                                {{ $v->status }}
                                            </span>
                                        </td>

                                        <td>{{ $v->driver ? $v->driver->name : 'No Driver' }}</td>
                                        <td class="text-center">
                                            <div class="d-inline-block"><a href="javascript:;"
                                                    class="btn btn-icon dropdown-toggle hide-arrow me-1"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded bx-md"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                                    <li><a href="javascript:;" class="dropdown-item">Details</a></li>
                                                    <li><a href="javascript:;" class="dropdown-item">Archive</a></li>
                                                    <div class="dropdown-divider"></div>
                                                    <li><a href="javascript:;"
                                                            class="dropdown-item text-danger delete-record">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <a href="javascript:;" class="btn btn-icon item-edit"><i
                                                    class="bx bx-edit bx-md"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="modal fade" id="add_new_vehicles" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Tambah Vehicle Baru</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('vehicle.add') }}" method="POST" class="add-new-record pt-0 row g-2"
                                id="form-add-new-record">
                                @csrf
                                <div class="modal-body">
                                    <div class="col-sm-12 mb-3">
                                        <label class="form-label" for="merk">Merk</label>
                                        <div class="form-group">
                                            <input type="text" id="merk"
                                                class="form-control @error('merk') is-invalid @enderror" name="merk"
                                                value="{{ old('merk') }}" placeholder="eg. Hyundai, Daihatsu" />
                                            @error('merk')
                                                <div class="invalid-feedback d-flex align-item-center">
                                                    <i class='bx bx-x'></i> {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <label class="form-label" for="type">Tipe</label>
                                        <div class="form-group">
                                            <input type="text" id="type"
                                                class="form-control @error('type') is-invalid @enderror" name="type"
                                                value="{{ old('type') }}" placeholder="eg. Pick Up Box" />
                                            @error('type')
                                                <div class="invalid-feedback d-flex align-item-center">
                                                    <i class='bx bx-x'></i> {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <label class="form-label" for="vehicle_number">Plat Nomor</label>
                                        <div class="form-group">
                                            <input type="text" id="vehicle_number" name="vehicle_number"
                                                class="form-control @error('vehicle_number') is-invalid @enderror"
                                                value="{{ old('vehicle_number') }}" placeholder="eg. B 2024 FNZ" />
                                        </div>
                                        @error('vehicle_number')
                                            <div class="invalid-feedback d-flex align-item-center">
                                                <i class='bx bx-x'></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btnFnz">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    @push('script')
        @if ($errors->any())
            <script>
                $(document).ready(function() {
                    $('#add_new_vehicles').modal('show');
                });
            </script>
        @endif
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    dom: 'l<"d-flex justify-content-between align-items-center mb-3 mt-3"<"d-flex gap-2"B><"d-flex"f>>rt<"d-flex justify-content-between"ip>',
                    // dom: 'Blfrtip',
                    buttons: [{
                        extend: "collection",
                        className: "btn btn-primary dropdown-toggle me-2",
                        text: '<i class="bx bx-export bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                        buttons: [{
                                extend: "print",
                                text: '<i class="bx bx-printer me-1"></i>Print',
                                className: "dropdown-item",
                            },
                            {
                                extend: "csv",
                                text: '<i class="bx bx-file me-1"></i>CSV',
                                className: "dropdown-item",
                            },
                            {
                                extend: "excel",
                                text: '<i class="bx bxs-file-export me-1"></i>Excel',
                                className: "dropdown-item",
                            },
                            {
                                extend: "pdf",
                                text: '<i class="bx bxs-file-pdf me-1"></i>PDF',
                                className: "dropdown-item",
                            },
                            {
                                extend: "copy",
                                text: '<i class="bx bx-copy me-1"></i>Copy',
                                className: "dropdown-item",
                            },
                        ],
                    }],
                    responsive: true,
                    // lengthMenu: false,
                    lengthMenu: [
                        [7, 10, 25, 50, -1],
                        [7, 10, 25, 50, "All"],
                    ],
                    language: {
                        lengthMenu: "Show _MENU_ entries",
                    },
                });


                @if (session('success'))
                    toastr.success("{{ session('success') }}");
                @endif

                @if (session('error'))
                    toastr.error("{{ session('error') }}");
                @endif
            });
        </script>
    @endpush
</x-app-layout>
