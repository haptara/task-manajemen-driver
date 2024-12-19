<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container-fluid flex-grow-1 container-p-y">

        <div class="app-kanban">
            <div class="kanban-wrapper ps fnz-kanban-wrapper">
                <div class="kanban-container fnz-kanban-container" id="kanban-container" style="width: 822px;">

                    @foreach ($boards as $b)
                        <div data-slug="{{ $b->slug }}" data-id="{{ $b->id }}" class="kanban-board"
                            style="width: 450px !important; margin-left: 12px; margin-right: 12px;">
                            <header class="kanban-board-header">
                                <div class="kanban-title-board">{{ $b->title }}</div>
                                <div class="dropdown">
                                    <i class="dropdown-toggle bx bx-dots-vertical-rounded cursor-pointer"
                                        id="board-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"></i>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="board-dropdown">
                                        <a class="dropdown-item delete-board" href="javascript:void(0)">
                                            <i class="bx bx-trash bx-xs"></i>
                                            <span class="align-middle">Delete All</span>
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="bx bx-edit-alt bx-xs"></i>
                                            <span class="align-middle">Update All</span>
                                        </a>
                                    </div>
                                </div>

                                @if ($b->slug === 'pending')
                                    <button class="kanban-title-button btn btn-default" data-bs-toggle="modal"
                                        data-bs-target="#add_new_item">+ Add New Item</button>
                                @endif
                            </header>
                            <main class="kanban-drag">

                                {{-- start foreach tasks --}}
                                @foreach ($b->tasks as $key => $t)
                                    @php
                                        $status_task = $t->status;
                                        if ($status_task == 'Urgent') {
                                            $label_status_task = 'danger';
                                        } elseif ($status_task == 'High Priority') {
                                            $label_status_task = 'warning';
                                        } elseif ($status_task == 'Normal Priority') {
                                            $label_status_task = 'primary';
                                        } elseif ($status_task == 'Low Priority') {
                                            $label_status_task = 'success';
                                        } else {
                                            $label_status_task = '';
                                        }
                                    @endphp
                                    <div class="kanban-item" data-eid="{{ $t->id }}"
                                        style="width: 27.5rem !important;">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center mb-2">
                                            <div class="item-badges">
                                                <div class="badge bg-label-{{ $label_status_task }}">
                                                    {{ $status_task }}
                                                </div>
                                            </div>
                                            <div class="dropdown kanban-tasks-item-dropdown"><i
                                                    class="dropdown-toggle bx bx-dots-vertical-rounded"
                                                    id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"></i>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="kanban-tasks-item-dropdown">
                                                    <a class="dropdown-item" href="javascript:void(0)">
                                                        Edit task
                                                    </a>
                                                    <a class="dropdown-item delete-task" href="javascript:void(0)">
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="kanban-text">{{ $t->title }}</span>
                                        <small class="text-muted">
                                            {{ $t->description }}
                                        </small>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                                            <div class="d-flex">
                                                <span class="d-flex align-items-center me-2">
                                                    <i class='bx bxs-truck me-1'></i>
                                                    <span class="attachments">
                                                        {{ ucwords($t->vehicle->merk) }} -
                                                        {{ ucwords($t->vehicle->type) }} -
                                                        {{ strtoupper($t->vehicle->vehicle_number) }}</span>
                                                </span>
                                            </div>
                                            <div class="avatar-group d-flex align-items-center assigned-avatar">
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    aria-label="{{ ucwords($t->driver->name) }}"
                                                    data-bs-original-title="{{ ucwords($t->driver->name) }}">
                                                    <span
                                                        class="avatar-initial rounded-circle bg-label-primary">SG</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                                            <div class="d-flex">
                                                <span class="d-flex align-items-center me-2">
                                                    <i class='bx bxs-time me-1'></i>
                                                    <span class="attachments">2 Jam ( Duration )</span>
                                                </span>
                                            </div>
                                        </div>

                                        <ul class="timeline mb-3 py-3">
                                            <li class="timeline-item ps-6 border-left-dashed">
                                                <span
                                                    class="timeline-indicator-advanced timeline-indicator-success border-0 shadow-none">
                                                    <i class='bx bx-check-circle'></i>
                                                </span>
                                                <div class="timeline-event ps-1">
                                                    <div class="timeline-header">
                                                        <small class="text-success text-uppercase">CHECK- IN</small>
                                                    </div>
                                                    <h6 class="my-0">{{ $t->starting_from }}</h6>
                                                    <small class="text-body mb-0">{{ $t->check_in }}</small>
                                                </div>
                                            </li>
                                            <li class="timeline-item ps-6 border-transparent">
                                                <span
                                                    class="timeline-indicator-advanced timeline-indicator-primary border-0 shadow-none">
                                                    <i class='bx bx-map'></i>
                                                </span>
                                                <div class="timeline-event ps-1">
                                                    <div class="timeline-header">
                                                        <small class="text-primary text-uppercase">CHECK-OUT</small>
                                                    </div>
                                                    <h6 class="my-0">{{ $t->finished_in }}</h6>
                                                    <p class="text-body mb-0">-</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <button class="btn btn-success btn-sm">Live Tracking</button>
                                    </div>
                                @endforeach
                                {{-- end foreach tasks --}}

                            </main>
                            <footer></footer>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <!-- Edit User Modal -->
        <div class="modal fade" id="add_new_item" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-6">
                            <h4 class="mb-2">Tambah Task Baru</h4>
                            <p>&nbsp;</p>
                        </div>
                        <form class="row g-6">
                            <div class="col-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="title">
                                        Title
                                        <span class="text-danger">*</span></label>
                                    <input type="text" id="title" name="title" class="form-control" />
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="description">Deskripsi</label>
                                    <textarea type="text" id="description" name="description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="driver">Driver</label>
                                    <select id="driver" name="driver" class="form-select">
                                        <option selected>-Pilih-</option>
                                        @foreach ($driver as $d)
                                            <option value="{{ $d->id }}">{{ $d->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="driver">Vehicle</label>
                                    <select id="driver" name="driver" class="form-select">
                                        <option selected>-Pilih-</option>
                                        @foreach ($vehicle as $v)
                                            <option value="{{ $v->id }}">{{ $v->merk }} /
                                                {{ $v->type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserEmail">Email</label>
                                <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                    class="form-control" placeholder="example@domain.com"
                                    value="example@domain.com" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserStatus">Status</label>
                                <select id="modalEditUserStatus" name="modalEditUserStatus"
                                    class="select2 form-select" aria-label="Default select example">
                                    <option selected>Status</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                    <option value="3">Suspended</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditTaxID">Tax ID</label>
                                <input type="text" id="modalEditTaxID" name="modalEditTaxID"
                                    class="form-control modal-edit-tax-id" placeholder="123 456 7890"
                                    value="123 456 7890" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserPhone">Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text">US (+1)</span>
                                    <input type="text" id="modalEditUserPhone" name="modalEditUserPhone"
                                        class="form-control phone-number-mask" placeholder="202 555 0111"
                                        value="202 555 0111" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserLanguage">Language</label>
                                <select id="modalEditUserLanguage" name="modalEditUserLanguage"
                                    class="select2 form-select" multiple>
                                    <option value="">Select</option>
                                    <option value="english" selected>English</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="french">French</option>
                                    <option value="german">German</option>
                                    <option value="dutch">Dutch</option>
                                    <option value="hebrew">Hebrew</option>
                                    <option value="sanskrit">Sanskrit</option>
                                    <option value="hindi">Hindi</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="modalEditUserCountry">Country</label>
                                <select id="modalEditUserCountry" name="modalEditUserCountry"
                                    class="select2 form-select" data-allow-clear="true">
                                    <option value="">Select</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Canada">Canada</option>
                                    <option value="China">China</option>
                                    <option value="France">France</option>
                                    <option value="Germany">Germany</option>
                                    <option value="India" selected>India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Korea">Korea, Republic of</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Russia">Russian Federation</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch my-2 ms-2">
                                    <input type="checkbox" class="form-check-input" id="editBillingAddress"
                                        checked />
                                    <label for="editBillingAddress" class="switch-label">Use as a billing
                                        address?</label>
                                </div>
                            </div> --}}
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-3">Submit</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->

    </div>

    @push('script')
        <script>
            $(document).ready(function() {

                // Ketika tombol Add new diklik
                $(".kanban-add-board-btn").on("click", function() {
                    // Menampilkan input dan tombol Add/Cancel
                    $(".kanban-add-board-input").removeClass("d-none");
                });

                // Ketika tombol Cancel diklik
                $(".kanban-add-board-cancel-btn").on("click", function() {
                    // Menyembunyikan input dan tombol Add/Cancel
                    $(".kanban-add-board-input").addClass("d-none");
                });

                $('#add-new-board').on('submit', function(e) {
                    e.preventDefault();

                    var boardTitle = $('#kanban-add-board-input').val().trim();
                    if (boardTitle) {
                        $.ajax({
                            url: '/store-board', // Endpoint untuk menambah board
                            method: 'POST',
                            data: {
                                title: boardTitle,
                                _token: '{{ csrf_token() }}' // CSRF token untuk keamanan
                            },
                            success: function(response) {
                                if (response.status === 'success') {

                                    // Menambahkan board baru secara langsung ke halaman
                                    var newBoard = `
                            <div data-slug="board-${response.board.slug}" data-order="${response.board.position}" class="kanban-board" style="width: 250px; margin-left: 12px; margin-right: 12px;">
                                <header class="kanban-board-header">
                                    <div class="kanban-title-board">${response.board.title}</div>
                                    <div class="dropdown">
                                        <i class="dropdown-toggle bx bx-dots-vertical-rounded cursor-pointer"
                                            id="board-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="board-dropdown">
                                            <a class="dropdown-item delete-board" href="javascript:void(0)"> <i
                                                class="bx bx-trash bx-xs"></i> <span class="align-middle">Delete</span></a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="bx bx-rename bx-xs"></i>
                                                <span class="align-middle">Rename</span></a>
                                            <a class="dropdown-item" href="javascript:void(0)"><i class="bx bx-archive bx-xs"></i>
                                                <span class="align-middle">Archive</span></a>
                                        </div>
                                    </div>
                                    <button class="kanban-title-button btn btn-default">+ Add New Item</button>
                                </header>
                                <main class="kanban-drag"></main>
                                <footer></footer>
                            </div>`;

                                    // $('#kanban-container').append(newBoard);
                                    // $('#kanban-container').prepend(newBoard);
                                    $('#kanban-container').find('.kanban-add-new-board').before(
                                        newBoard);

                                    // Sembunyikan input dan reset nilai input
                                    $('#kanban-add-board-input').addClass('d-none');
                                    $('#kanban-add-board-input').val('');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                toastr.error("Server Error");
                            }
                        });

                    } else {
                        toastr.warning("Title tidak boleh kosong!");
                    }
                });

                $(document).on('click', '.delete-board', function() {
                    alert('delete')
                });

                @if (session('success'))
                    toastr.success("{{ session('success') }}");
                @endif


                var kanbanWrapper = $(".fnz-kanban-wrapper");
                if (kanbanWrapper.length > 0) {
                    new PerfectScrollbar(kanbanWrapper[0]);
                }

                var kanbanContainer = $(".fnz-kanban-container");

            });
        </script>
    @endpush

</x-app-layout>
