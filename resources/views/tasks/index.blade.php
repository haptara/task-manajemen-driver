<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @php
        function convertMinutesToHours($minutes)
        {
            $hours = floor($minutes / 60); // Menghitung jam
            $remainingMinutes = $minutes % 60; // Menghitung sisa menit

            // Jika durasi tepat jam, hanya tampilkan jam
            if ($remainingMinutes == 0) {
                return "{$hours} jam";
            }

            // Jika ada menit sisa, tampilkan jam dan menit
            return "{$hours} jam {$remainingMinutes} menit";
        }
    @endphp
    <div class="container-fluid flex-grow-1 container-p-y">

        <div class="app-kanban">
            <div class="kanban-wrapper ps fnz-kanban-wrapper">
                <div class="kanban-container fnz-kanban-container" id="fnz-kanban-container" style="width: 822px;">

                    @foreach ($boards as $b)
                        <div data-slug="{{ $b->slug }}" data-id="{{ $b->id }}" class="kanban-board"
                            style="width: 450px !important; margin-left: 12px; margin-right: 12px;">
                            <header class="kanban-board-header">
                                <div class="kanban-title-board">{{ ucwords($b->title) }}</div>
                                <div class="dropdown">
                                    <i class="dropdown-toggle bx bx-dots-vertical-rounded cursor-pointer"
                                        id="board-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"></i>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="board-dropdown">
                                        <a class="dropdown-item delete-board" href="javascript:void(0)">
                                            <i class="bx bx-trash bx-xs"></i>
                                            <span class="align-middle">Delete All</span>
                                        </a>
                                        {{-- <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="bx bx-edit-alt bx-xs"></i>
                                            <span class="align-middle">Update Status All</span>
                                        </a> --}}
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
                                        $badgeColor = match ($status_task) {
                                            'Urgent' => 'danger',
                                            'High Priority' => 'warning',
                                            'Normal Priority' => 'primary',
                                            'Low Priority' => 'success',
                                            default => 'secondary',
                                        };
                                    @endphp
                                    <div class="kanban-item sortable-list" id="{{ $b->slug }}-list"
                                        data-eid="{{ $t->id }}" style="width: 27.5rem !important;">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center mb-2">
                                            <div class="item-badges">
                                                <div class="badge bg-label-{{ $badgeColor }}">
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
                                        <span class="kanban-text">{{ ucwords($t->title) }}</span>
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
                                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                                        {{ strtoupper(substr(implode('', array_map(fn($word) => $word[0], explode(' ', $t->driver->name))), 0, 2)) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                                            <div class="d-flex">
                                                <span class="d-flex align-items-center me-2">
                                                    <i class='bx bxs-time me-1'></i>
                                                    <span class="attachments">{{ convertMinutesToHours($t->duration) }}
                                                        (Duration)
                                                    </span>
                                                </span>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="d-flex align-items-center my-2 justify-content-between">
                                            <div class="avatar flex-shrink-0 me-2">
                                                <span class="avatar-initial rounded bg-label-success">
                                                    <i class='bx bx-log-in'></i>
                                                </span>
                                            </div>
                                            <div class="d-flex w-100 flex-wrap align-items-center">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Checkin</h6>
                                                    <small id="check_in-{{ $t->id }}"
                                                        class="text-danger">{{ $t->check_in ?? 'xxxx-xx-xx xx:xx:xx' }}</small>
                                                </div>
                                            </div>

                                            <div class="avatar flex-shrink-0 me-2">
                                                <span class="avatar-initial rounded bg-label-primary">
                                                    <i class='bx bx-log-out'></i>
                                                </span>
                                            </div>
                                            <div class="d-flex w-100 flex-wrap align-items-center">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Checkout</h6>
                                                    <small id="check_out-{{ $t->id }}"
                                                        class="text-danger">{{ $t->check_out ?? 'xxxx-xx-xx xx:xx:xx' }}</small>
                                                </div>
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
                                                        <small class="text-success text-uppercase">Sender</small>
                                                    </div>
                                                    <h6 class="my-0">{{ ucfirst($t->starting_from) }}</h6>
                                                    {{-- <small class="text-body mb-0">{{ $t->check_in }}</small> --}}
                                                </div>
                                            </li>
                                            <li class="timeline-item ps-6 border-transparent">
                                                <span
                                                    class="timeline-indicator-advanced timeline-indicator-primary border-0 shadow-none">
                                                    <i class='bx bx-map'></i>
                                                </span>
                                                <div class="timeline-event ps-1">
                                                    <div class="timeline-header">
                                                        <small class="text-primary text-uppercase">Receiver</small>
                                                    </div>
                                                    <h6 class="my-0">{{ ucfirst($t->finished_in) }}</h6>
                                                    {{-- <p class="text-body mb-0">-</p> --}}
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <div class="text-center mb-6">
                            <h4 class="mb-2">Tambah Task Baru</h4>
                            <p>&nbsp;</p>
                        </div>

                        @if ($driver->count() > 0 && $vehicle->count() > 0)

                            @php
                                $val_deskripsi = old('description');
                            @endphp
                            <form action="{{ route('tasks.store') }}" method="POST" class="row g-6">
                                @csrf
                                <div class="col-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="title">
                                            Title
                                            <span class="text-danger">*</span></label>
                                        <input type="text" id="title" name="title"
                                            value="{{ old('title') }}"
                                            class="form-control @error('title') is-invalid @enderror" />
                                        @error('title')
                                            <div class="invalid-feedback d-flex align-item-center">
                                                <i class='bx bx-x'></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="description">Deskripsi</label>
                                        <textarea type="text" id="description" name="description" class="form-control">{{ $val_deskripsi }}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="driver">Driver</label>
                                        <select id="driver" name="driver"
                                            class="form-select @error('driver') is-invalid @enderror">
                                            <option selected>-Pilih-</option>
                                            @foreach ($driver as $d)
                                                <option value="{{ $d->id }}" @selected(old('driver') == $d->id)>
                                                    {{ ucwords($d->name) }}</option>
                                            @endforeach
                                        </select>
                                        @error('driver')
                                            <div class="invalid-feedback d-flex align-item-center">
                                                <i class='bx bx-x'></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="vehicle">Vehicle</label>
                                        <select id="vehicle" name="vehicle"
                                            class="form-select @error('vehicle') is-invalid @enderror">
                                            <option selected>-Pilih-</option>
                                            @foreach ($vehicle as $v)
                                                <option value="{{ $v->id }}" @selected(old('vehicle') == $v->id)>
                                                    {{ ucwords($v->merk) }} /
                                                    {{ $v->type }}</option>
                                            @endforeach
                                        </select>
                                        @error('vehicle')
                                            <div class="invalid-feedback d-flex align-item-center">
                                                <i class='bx bx-x'></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="starting_from" class="form-label">Sender / Mulai Dari</label>
                                        <input type="text"
                                            class="form-control @error('starting_from') is-invalid @enderror"
                                            name="starting_from" value="{{ old('starting_from') }}"
                                            id="starting_from">
                                        @error('starting_from')
                                            <div class="invalid-feedback d-flex align-item-center">
                                                <i class='bx bx-x'></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="finished_in" class="form-label">Received / Finished In</label>
                                        <input type="text"
                                            class="form-control @error('finished_in') is-invalid @enderror"
                                            value="{{ old('finished_in') }}" name="finished_in" id="finished_in">
                                        @error('finished_in')
                                            <div class="invalid-feedback d-flex align-item-center">
                                                <i class='bx bx-x'></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="status">Status</label>
                                        <select name="status" id="status"
                                            class="form-control @error('status') is-invalid @enderror">
                                            <option value="">-Pilih-</option>
                                            <option value="Urgent" @selected(old('status') == 'Urgent')>Urgent</option>
                                            <option value="High Priority" @selected(old('status') == 'High Priority')>High Priority
                                            </option>
                                            <option value="Normal Priority" @selected(old('status') == 'Normal Priority')>Normal
                                                Priority
                                            </option>
                                            <option value="Low Priority" @selected(old('status') == 'Low Priority')>Low Priority
                                            </option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback d-flex align-item-center">
                                                <i class='bx bx-x'></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="duration">Durasi (Menit)</label>
                                        <input type="number"
                                            class="form-control @error('duration') is-invalid @enderror"
                                            name="duration" id="duration" min="0"
                                            value="{{ old('duration') }}">
                                        @error('duration')
                                            <div class="invalid-feedback d-flex align-item-center">
                                                <i class='bx bx-x'></i> {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-3 btnFnz">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">Cancel</button>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <h6 class="alert-heading d-flex align-items-center mb-1">Alert</h6>
                                @if ($driver->count() == 0)
                                    <p class="mb-0">Data Driver sedang full.</p>
                                @endif
                                @if ($vehicle->count() == 0)
                                    <p class="mb-0">Data Kendaraan sedang full.</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit User Modal -->


        {{-- DELETE --}}
        <div class="modal fade" id="deleteTaskModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus tugas ini? Tindakan ini tidak dapat dibatalkan.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteTask">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- DELETE --}}
    </div>

    @push('script')
        @if ($errors->any())
            <script>
                $(document).ready(function() {
                    $('#add_new_item').modal('show');
                });
            </script>
        @endif
        <script>
            $(document).ready(function() {

                let taskIdToDelete = null; // Menyimpan ID task yang akan dihapus
                let taskElementToDelete = null; // Menyimpan elemen DOM task

                // Event saat tombol "Delete" diklik
                $(document).on('click', '.delete-task', function() {
                    taskElementToDelete = $(this).closest('.kanban-item'); // Elemen task
                    taskIdToDelete = taskElementToDelete.data('eid'); // ID task dari atribut data

                    // Tampilkan modal konfirmasi
                    $('#deleteTaskModal').modal('show');
                });

                $('#confirmDeleteTask').on('click', function() {
                    if (taskIdToDelete) {
                        $.ajax({
                            url: '{{ route('delete-task') }}',
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: taskIdToDelete
                            },
                            success: function(response) {
                                if (response.success) {
                                    taskElementToDelete.fadeOut(300, function() {
                                        $(this).remove();
                                    });
                                    $('#deleteTaskModal').modal('hide');
                                } else {
                                    toastr.error(response.message || 'Failed to delete the task.');
                                }
                            },
                            error: function(xhr) {
                                toastr.error(xhr.responseJSON.message ||
                                    'An error occurred while deleting the task.');
                            }
                        });
                    }
                });

                $(".kanban-drag").each(function() {
                    // const slug = $(this).closest('.kanban-board').data('slug');
                    const el = this;

                    new Sortable(el, {
                        group: 'kanban',
                        animation: 150,
                        onEnd: function(evt) {
                            const item = $(evt.item);
                            const itemId = item.data('eid');
                            // const newStatus = $(evt.to).closest('.kanban-board').data('slug');
                            const oldSlug = $(evt.from).closest(".kanban-board").data(
                                "slug"); // Slug sebelumnya
                            const newSlug = $(evt.to).closest(".kanban-board").data(
                                "slug"); // Slug tujuan

                            if (
                                (oldSlug === "completed" && newSlug === "in-progress") ||
                                (oldSlug === "in-progress" && newSlug === "pending") ||
                                (oldSlug === "completed" && newSlug === "pending") ||
                                (oldSlug === "pending" && newSlug === "completed")
                            ) {
                                toastr.error("Drag and drop ini tidak diperbolehkan.");
                                return evt.from.appendChild(evt.item);
                            }
                            // if ((slug === 'completed' && newStatus === 'in-progress') ||
                            //     (slug === 'in-progress' && newStatus === 'pending') ||
                            //     (slug === 'pending' && newStatus === 'completed')) {
                            //     toastr.error('Drag and drop ini tidak diperbolehkan.');
                            //     return evt.from.appendChild(evt.item);
                            // }

                            $.ajax({
                                url: '{{ route('update-status') }}',
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: itemId,
                                    status: newSlug
                                },
                                success: function(response) {
                                    // console.log(response.data.status);
                                    if (response.data.board_id == '3') {
                                        $('#check_out-' + response.data.id).html(
                                            response
                                            .data
                                            .check_out);
                                    }
                                    $('#check_in-' + response.data.id).html(response
                                        .data
                                        .check_in);

                                    $(evt.to).closest(".kanban-board").data("slug",
                                        response.data.status);
                                },
                                error: function(xhr) {
                                    toastr.error(xhr.responseJSON.message);
                                    evt.from.appendChild(evt.item);
                                }
                            });
                        }
                    });

                })

                @if (session('success'))
                    toastr.success("{{ session('success') }}");
                @endif

                @if (session('error'))
                    toastr.success("{{ session('success') }}");
                @endif


                var kanbanWrapper = $(".fnz-kanban-wrapper");
                if (kanbanWrapper.length > 0) {
                    new PerfectScrollbar(kanbanWrapper[0]);
                }

                // var kanbanContainer = $(".fnz-kanban-container");

            });
        </script>
    @endpush

</x-app-layout>
