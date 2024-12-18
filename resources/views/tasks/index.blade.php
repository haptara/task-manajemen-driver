<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container-fluid flex-grow-1 container-p-y">

        <div class="app-kanban">
            <div class="kanban-wrapper ps fnz-kanban-wrapper">
                <div class="kanban-container fnz-kanban-container" id="kanban-container" style="width: 822px;">
                    <div data-slug="1" data-order="1" class="kanban-board"
                        style="width: 250px; margin-left: 12px; margin-right: 12px;">
                        <header class="kanban-board-header">
                            <div class="kanban-title-board">Pending</div>
                            <div class="dropdown"><i class="dropdown-toggle bx bx-dots-vertical-rounded cursor-pointer"
                                    id="board-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"></i>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="board-dropdown"><a
                                        class="dropdown-item delete-board" href="javascript:void(0)"> <i
                                            class="bx bx-trash bx-xs" me-1=""></i> <span
                                            class="align-middle">Delete</span></a><a class="dropdown-item"
                                        href="javascript:void(0)"><i class="bx bx-rename bx-xs" me-1=""></i>
                                        <span class="align-middle">Rename</span></a><a class="dropdown-item"
                                        href="javascript:void(0)"><i class="bx bx-archive bx-xs" me-1=""></i>
                                        <span class="align-middle">Archive</span></a></div>
                            </div><button class="kanban-title-button btn btn-default">+ Add New Item</button>
                        </header>
                        <main class="kanban-drag">
                            <div class="kanban-item" data-eid="1">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2">
                                    <div class="item-badges">
                                        <div class="badge bg-label-success">08:00
                                        </div>
                                        -
                                        <div class="badge bg-label-primary">11:00
                                        </div>
                                    </div>
                                    <div class="dropdown kanban-tasks-item-dropdown"><i
                                            class="dropdown-toggle bx bx-dots-vertical-rounded"
                                            id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="kanban-tasks-item-dropdown"><a class="dropdown-item"
                                                href="javascript:void(0)">Copy task
                                                link</a><a class="dropdown-item" href="javascript:void(0)">Duplicate
                                                task</a><a class="dropdown-item delete-task"
                                                href="javascript:void(0)">Delete</a>
                                        </div>
                                    </div>
                                </div><span class="kanban-text">Pengantaran Bahan Baku</span>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-center me-2">
                                            <i class="bx bx-paperclip me-1"></i>
                                            <span class="attachments">4</span>
                                        </span>
                                        <span class="d-flex align-items-center ms-2">
                                            <i class="bx bx-chat me-1"></i>
                                            <span>1</span>
                                        </span>
                                    </div>
                                    <div class="avatar-group d-flex align-items-center assigned-avatar">
                                        <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                            aria-label="Driver 1" data-bs-original-title="Driver 1">
                                            <span class="avatar-initial rounded-circle bg-label-primary">d1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        <footer></footer>
                    </div>

                    <div data-slug="1" data-order="1" class="kanban-board"
                        style="width: 50px; margin-left: 12px; margin-right: 12px;">
                        <header class="kanban-board-header">
                            <div class="kanban-title-board">In Progress</div>
                            <div class="dropdown"><i class="dropdown-toggle bx bx-dots-vertical-rounded cursor-pointer"
                                    id="board-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"></i>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="board-dropdown"><a
                                        class="dropdown-item delete-board" href="javascript:void(0)"> <i
                                            class="bx bx-trash bx-xs" me-1=""></i> <span
                                            class="align-middle">Delete</span></a><a class="dropdown-item"
                                        href="javascript:void(0)"><i class="bx bx-rename bx-xs" me-1=""></i>
                                        <span class="align-middle">Rename</span></a><a class="dropdown-item"
                                        href="javascript:void(0)"><i class="bx bx-archive bx-xs" me-1=""></i>
                                        <span class="align-middle">Archive</span></a></div>
                            </div><button class="kanban-title-button btn btn-default">+ Add New Item</button>
                        </header>
                        <main class="kanban-drag">
                            <div class="kanban-item" data-eid="1">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2">
                                    <div class="item-badges">
                                        <div class="badge bg-label-success">08:00
                                        </div>
                                        -
                                        <div class="badge bg-label-primary">11:00
                                        </div>
                                    </div>
                                    <div class="dropdown kanban-tasks-item-dropdown"><i
                                            class="dropdown-toggle bx bx-dots-vertical-rounded"
                                            id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="kanban-tasks-item-dropdown"><a class="dropdown-item"
                                                href="javascript:void(0)">Copy task
                                                link</a><a class="dropdown-item" href="javascript:void(0)">Duplicate
                                                task</a><a class="dropdown-item delete-task"
                                                href="javascript:void(0)">Delete</a>
                                        </div>
                                    </div>
                                </div><span class="kanban-text">Pengantaran Bahan Baku</span>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-center me-2">
                                            <i class="bx bx-paperclip me-1"></i>
                                            <span class="attachments">4</span>
                                        </span>
                                        <span class="d-flex align-items-center ms-2">
                                            <i class="bx bx-chat me-1"></i>
                                            <span>1</span>
                                        </span>
                                    </div>
                                    <div class="avatar-group d-flex align-items-center assigned-avatar">
                                        <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                            data-bs-placement="top" aria-label="Driver 1"
                                            data-bs-original-title="Driver 1">
                                            <span class="avatar-initial rounded-circle bg-label-primary">d1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        <footer></footer>
                    </div>

                    <div data-slug="1" data-order="1" class="kanban-board"
                        style="width: 50px; margin-left: 12px; margin-right: 12px;">
                        <header class="kanban-board-header">
                            <div class="kanban-title-board">Completed</div>
                            <div class="dropdown"><i
                                    class="dropdown-toggle bx bx-dots-vertical-rounded cursor-pointer"
                                    id="board-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false"></i>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="board-dropdown"><a
                                        class="dropdown-item delete-board" href="javascript:void(0)"> <i
                                            class="bx bx-trash bx-xs" me-1=""></i> <span
                                            class="align-middle">Delete</span></a><a class="dropdown-item"
                                        href="javascript:void(0)"><i class="bx bx-rename bx-xs" me-1=""></i>
                                        <span class="align-middle">Rename</span></a><a class="dropdown-item"
                                        href="javascript:void(0)"><i class="bx bx-archive bx-xs" me-1=""></i>
                                        <span class="align-middle">Archive</span></a></div>
                            </div><button class="kanban-title-button btn btn-default">+ Add New Item</button>
                        </header>
                        <main class="kanban-drag">
                            <div class="kanban-item" data-eid="1">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2">
                                    <div class="item-badges">
                                        <div class="badge bg-label-success">08:00
                                        </div>
                                        -
                                        <div class="badge bg-label-primary">11:00
                                        </div>
                                    </div>
                                    <div class="dropdown kanban-tasks-item-dropdown"><i
                                            class="dropdown-toggle bx bx-dots-vertical-rounded"
                                            id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="kanban-tasks-item-dropdown"><a class="dropdown-item"
                                                href="javascript:void(0)">Copy task
                                                link</a><a class="dropdown-item" href="javascript:void(0)">Duplicate
                                                task</a><a class="dropdown-item delete-task"
                                                href="javascript:void(0)">Delete</a>
                                        </div>
                                    </div>
                                </div><span class="kanban-text">Pengantaran Bahan Baku</span>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2">
                                    <div class="d-flex">
                                        <span class="d-flex align-items-center me-2">
                                            <i class="bx bx-paperclip me-1"></i>
                                            <span class="attachments">4</span>
                                        </span>
                                        <span class="d-flex align-items-center ms-2">
                                            <i class="bx bx-chat me-1"></i>
                                            <span>1</span>
                                        </span>
                                    </div>
                                    <div class="avatar-group d-flex align-items-center assigned-avatar">
                                        <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                            data-bs-placement="top" aria-label="Driver 1"
                                            data-bs-original-title="Driver 1">
                                            <span class="avatar-initial rounded-circle bg-label-primary">d1</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                        <footer></footer>
                    </div>

                </div>
            </div>
        </div>

    </div>

</x-app-layout>
