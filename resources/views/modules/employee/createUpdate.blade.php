@extends('layouts.admin.app')
@section('title', $title)
@section('css')
@endsection
@section('admin_content')

    {{-- breadcrumbs --}}
    @component('components.breadcrumbs', [
        'parent' => 'Role',
        'page' => $title,
        'parent_url' => 'dashboard',
    ])
    @endcomponent

    @component('components.heading', [
        'pageTitle' => $title,
        'anotherPageIcon' => 'bi bi-plus',
        'anotherPageUrl' => 'employee.index',
    ])
    @endcomponent

    <section class="section dashboard">
        <div class="bg-white p-3 rounded shadow">
            <section class="form-group">
                <form action="@route('employee.store')" method="POST" enctype="multipart/form-data">
                    @csrf
                    <section class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                            <label for="" class="text-muted">Employee Name <span class="text-danger">*</span> </label>
                            <input type="text" name="name" class="form-control" required placeholder="Mr.devid albin"
                                id="">
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                            <label for="" class="text-muted">Employee Phone <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="phone" class="form-control" required placeholder="018XXXXXXXXXX"
                                id="">
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                            <label for="" class="text-muted">Employee Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="email" class="form-control" required placeholder="devid@gamil.com"
                                id="">
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                            <label for="" class="text-muted">Employee Designation </label>
                            <input type="text" name="designation" class="form-control" placeholder="Admin"
                                id="">
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                            <label for="" class="text-muted">Employee Profile Pic </label>
                            <input type="file" name="profile_pic" class="form-control" placeholder="" id="">
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                            <label for="" class="text-muted">Employee Gender </label>
                            <select name="gender" class="form-control" id="">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                            <label for="" class="text-muted">Employee Join Date</label>
                            <input type="date" name="join_date" class="form-control" placeholder="" id="">
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                            <label for="" class="text-muted">Employee Date of Birth </label>
                            <input type="date" name="date_of_birth" class="form-control" placeholder="" id="">
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                            <label for="" class="text-muted">Employee Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password" class="form-control" required placeholder=""
                                id="">
                        </div>

                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                            <label for="" class="text-muted">Employee Address</label>
                            <input type="text" name="address" class="form-control"
                                placeholder="New Eskaton, banglamotor, dhaka, bangladesh" id="">
                        </div>

                        <div class="text-center mt-1">
                            <button class="btn btn-sm btn-success" type="submit">Submit</button>
                        </div>

                    </section>
                </form>
            </section>
        </div>
    </section>
@endsection
