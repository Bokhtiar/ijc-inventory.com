@extends('layouts.admin.app')
@section('title', $title)
@section('admin_content')


    {{-- breadcrumbs --}}
    @component('components.breadcrumbs', [
        'parent' => 'Home',
        'page' => $title,
        'parent_url' => 'dashboard',
    ])
    @endcomponent

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- total course Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Billing <span></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ App\Models\Billing::count() }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Sales Card -->

                    <!-- registration Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Services</span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bar-chart-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ App\Models\Service::count() }}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End registration Card -->
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
@endsection
