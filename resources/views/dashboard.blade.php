<x-app-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="row g-6 py-4">
            <div class="col-lg-12 order-lg-3 col-12 align-self-end order-4">
                <div class="card">
                    <div class="d-flex row">
                        <div class="col-sm-3 text-center text-sm-left">
                            <div class="card-body pb-0 ps-10 text-sm-start text-center">
                                <img src="{{ asset('assets/img/sitting-girl-with-laptop.png') }}" height="181"
                                    alt="Target User">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-3">Welcome back {{ auth()->user()->name }}!</h5>
                                <p class="mb-6">You have 12 task to finish today, Your already completed 189 task good
                                    job.</p>

                                <span class="badge bg-label-primary">78% of TARGET</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row g-6">
            <!-- Card Border Shadow -->
            <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-primary"><i
                                        class="bx bxs-truck bx-lg"></i></span>
                            </div>
                            <h4 class="mb-0">41</h4>
                        </div>
                        <p class="mb-2">Total Task</p>
                        <p class="mb-0">
                            <span class="text-heading fw-medium me-2">+18.2%</span>
                            <span class="text-muted">than last week</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class='bx bx-error bx-lg'></i></span>
                            </div>
                            <h4 class="mb-0">8</h4>
                        </div>
                        <p class="mb-2">Vehicles with errors</p>
                        <p class="mb-0">
                            <span class="text-heading fw-medium me-2">-8.7%</span>
                            <span class="text-muted">than last week</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-danger"><i
                                        class='bx bx-git-repo-forked bx-lg'></i></span>
                            </div>
                            <h4 class="mb-0">27</h4>
                        </div>
                        <p class="mb-2">Deviated from route</p>
                        <p class="mb-0">
                            <span class="text-heading fw-medium me-2">+4.3%</span>
                            <span class="text-muted">than last week</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card card-border-shadow-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="avatar me-4">
                                <span class="avatar-initial rounded bg-label-info"><i
                                        class='bx bx-time-five bx-lg'></i></span>
                            </div>
                            <h4 class="mb-0">13</h4>
                        </div>
                        <p class="mb-2">Late vehicles</p>
                        <p class="mb-0">
                            <span class="text-heading fw-medium me-2">-2.5%</span>
                            <span class="text-muted">than last week</span>
                        </p>
                    </div>
                </div>
            </div>
            <!--/ Card Border Shadow -->
        </div>


    </div>

</x-app-layout>
