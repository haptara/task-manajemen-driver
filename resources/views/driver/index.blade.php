<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container-fluid flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-xl">
                <div class="card">

                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="text-primary">Daftar Driver</h4>
                            <button class="btn btn-secondary btn-primary" data-bs-toggle="offcanvas"
                                data-bs-target="#add_new_driver" aria-controls="offcanvasEnd" type="button"><span><i
                                        class="bx bx-plus bx-sm me-sm-2"></i>
                                    <span class="d-none d-sm-inline-block">Tambah Driver Baru</span></span></button>
                        </div>
                    </div>
                    <div class="card-body">

                        <table id="example" class="table table-striped border-top"" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No.Handphone</th>
                                    <th>Create_at</th>
                                    <th class="text-center">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($driver as $d)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ strtoupper($d->name) }}</td>
                                        <td>{{ strtolower($d->email) }}</td>
                                        <td>{{ $d->phone }}</td>
                                        <td>{{ $d->created_at }}</td>
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

                <div class="offcanvas offcanvas-end" id="add_new_driver">
                    <div class="offcanvas-header border-bottom">
                        <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Driver Baru</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body flex-grow-1">
                        <form action="{{ route('driver.add') }}" method="POST" class="add-new-record pt-0 row g-2"
                            id="form-add-new-record">
                            @csrf
                            <div class="col-sm-12">
                                <label class="form-label" for="name">Nama Lengkap</label>
                                <div class="form-group">
                                    <input type="text" id="name"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" placeholder="eg. Fulan bin Fulan" />
                                    @error('name')
                                        <div class="invalid-feedback d-flex align-item-center">
                                            <i class='bx bx-x'></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label" for="email">Email</label>
                                <div class="form-group">
                                    <input type="text" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="eg. john.doe@example.com" />
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-flex align-item-center">
                                        <i class='bx bx-x'></i> {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label" for="phone">No. Handphone</label>
                                <div class="form-group">
                                    <input type="number" id="phone" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}" placeholder="08" />
                                    @error('phone')
                                        <div class="invalid-feedback d-flex align-item-center">
                                            <i class='bx bx-x'></i> {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit"
                                    class="btn btn-primary data-submit me-sm-4 me-1 btnFnz">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary"
                                    data-bs-dismiss="offcanvas">Cancel</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

    @push('script')
        @if ($errors->any())
            <script>
                const offcanvas = new bootstrap.Offcanvas(document.getElementById('add_new_driver'));
                offcanvas.show();
            </script>
        @endif
        <script>
            $(document).ready(function() {
                $('#example').DataTable({
                    // dom: '<"d-flex justify-content-between align-items-center mb-3"<"d-flex gap-2"lB><"d-flex"f>>rt<"d-flex justify-content-between"ip>',
                    // dom: 'Blfrtip',
                    // buttons: [{
                    //     extend: "collection",
                    //     className: "btn btn-primary dropdown-toggle me-2",
                    //     text: '<i class="bx bx-export bx-sm me-sm-2"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    //     buttons: [{
                    //             extend: "print",
                    //             text: '<i class="bx bx-printer me-1"></i>Print',
                    //             className: "dropdown-item",
                    //         },
                    //         {
                    //             extend: "csv",
                    //             text: '<i class="bx bx-file me-1"></i>CSV',
                    //             className: "dropdown-item",
                    //         },
                    //         {
                    //             extend: "excel",
                    //             text: '<i class="bx bxs-file-export me-1"></i>Excel',
                    //             className: "dropdown-item",
                    //         },
                    //         {
                    //             extend: "pdf",
                    //             text: '<i class="bx bxs-file-pdf me-1"></i>PDF',
                    //             className: "dropdown-item",
                    //         },
                    //         {
                    //             extend: "copy",
                    //             text: '<i class="bx bx-copy me-1"></i>Copy',
                    //             className: "dropdown-item",
                    //         },
                    //     ],
                    // }],
                    responsive: true,
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
            });
        </script>
    @endpush
</x-app-layout>
