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

    </div>

</x-app-layout>
