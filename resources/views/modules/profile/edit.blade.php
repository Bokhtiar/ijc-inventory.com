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


        <section class="section dashboard">
            <div class="bg-white p-3 rounded shadow">
                <section class="section profile">
                    <div class="row">
                        <div class="col-xl-4">

                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                                    <img src="{{ asset(@$edit->profile_pic ? $edit->profile_pic : 'admin/assets/img/avater.jpg') }}"
                                        alt="image" class="rounded-circle">
                                    <h2>{{ @$edit->name }}</h2>
                                    <h3>{{ @$edit->designation }}</h3>

                                </div>
                            </div>

                        </div>

                        <div class="col-xl-8">

                            <div class="card">
                                <div class="card-body pt-3">
                                    <!-- Bordered Tabs -->
                                    <ul class="nav nav-tabs nav-tabs-bordered">

                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab"
                                                data-bs-target="#profile-overview">Overview</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-edit">Edit Profile</button>
                                        </li>

                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="tab"
                                                data-bs-target="#profile-change-password">Change Password</button>
                                        </li>

                                    </ul>
                                    <div class="tab-content pt-2">

                                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                            <h5 class="card-title">Profile Details</h5>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                                <div class="col-lg-9 col-md-8">{{ $edit->name }}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Phone</div>
                                                <div class="col-lg-9 col-md-8">{{ $edit->phone }}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Email</div>
                                                <div class="col-lg-9 col-md-8">{{ $edit->email }}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Gender</div>
                                                <div class="col-lg-9 col-md-8">{{ $edit->gender }}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Date of birth</div>
                                                <div class="col-lg-9 col-md-8">{{ $edit->date_of_birth }}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Join date</div>
                                                <div class="col-lg-9 col-md-8">{{ $edit->join_date }}</div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 label">Address</div>
                                                <div class="col-lg-9 col-md-8">{{ $edit->address }}</div>
                                            </div>

                                        </div>

                                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                            <section class="form-group">
                                                @if (@$edit)
                                                    <form action="@route('user.update', $edit->id)" method="POST"
                                                        enctype="multipart/form-data">
                                                        @method('PUT')
                                                @endif
                                                @csrf
                                                <section class="row">
                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                                                        <label for="" class="text-muted">Employee Name <span
                                                                class="text-danger">*</span> </label>
                                                        <input type="text" name="name" value="{{ @$edit->name }}"
                                                            class="form-control" required placeholder="Mr.devid albin"
                                                            id="">
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                                                        <label for="" class="text-muted">Employee Phone <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="number" name="phone" value="{{ @$edit->phone }}"
                                                            class="form-control" required placeholder="018XXXXXXXXXX"
                                                            id="">
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                                                        <label for="" class="text-muted">Employee Email <span
                                                                class="text-danger">*</span>
                                                        </label>
                                                        <input type="email" name="email" value="{{ @$edit->email }}"
                                                            class="form-control" required placeholder="devid@gamil.com"
                                                            id="">
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                                                        <label for="" class="text-muted">Employee Designation
                                                        </label>
                                                        <input type="text" name="designation"
                                                            value="{{ @$edit->designation }}" class="form-control"
                                                            placeholder="Admin" id="">
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                                                        <label for="" class="text-muted">Employee Gender </label>
                                                        <select name="gender" class="form-control" id="">
                                                            <option value="male"
                                                                {{ @$edit->gender == 'male' ? 'selected' : '' }}>Male
                                                            </option>
                                                            <option value="female"
                                                                {{ @$edit->gender == 'female' ? 'selected' : '' }}>Female
                                                            </option>
                                                            <option value="others"
                                                                {{ @$edit->gender == 'others' ? 'selected' : '' }}>Others
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                                                        <label for="" class="text-muted">Employee Join
                                                            Date</label>
                                                        <input type="date" name="join_date"
                                                            value="{{ @$edit->join_date }}" class="form-control"
                                                            placeholder="" id="">
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                                                        <label for="" class="text-muted">Employee Date of Birth
                                                        </label>
                                                        <input type="date" name="date_of_birth"
                                                            value="{{ @$edit->date_of_birth }}" class="form-control"
                                                            placeholder="" id="">
                                                    </div>

                                                    @if (!@$edit)
                                                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                                                            <label for="" class="text-muted">Employee Password
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="password" name="password" value=""
                                                                class="form-control" required placeholder=""
                                                                id="">
                                                        </div>
                                                    @endif
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-1">
                                                        <label for="" class="text-muted">Employee Address</label>
                                                        <input type="text" name="address"
                                                            value="{{ @$edit->address }}" class="form-control"
                                                            placeholder="New Eskaton, banglamotor, dhaka, bangladesh"
                                                            id="">
                                                    </div>

                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-1">
                                                        <label for="" class="text-muted">Employee Profile Pic
                                                        </label>
                                                        <input type="file" name="profile_pic" class="form-control"
                                                            placeholder="" id="">
                                                        @if (@$edit->profile_pic)
                                                            <img src="{{ asset($edit->profile_pic) }}" height="100"
                                                                width="100" alt="">
                                                        @endif
                                                    </div>

                                                    <div class="text-center mt-1">
                                                        <button class="btn btn-sm btn-success"
                                                            type="submit">Submit</button>
                                                    </div>

                                                </section>
                                                </form>
                                            </section>

                                        </div>



                                        <div class="tab-pane fade pt-3" id="profile-change-password">
                                            <form method="POST" action="@route('password-change')">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="password"
                                                        class=" col-form-label text-md-right">{{ __('Password') }}</label>
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="old_password" required autocomplete="new-password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password"
                                                        class=" col-form-label text-md-right">{{ __('New Password') }}</label>
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="new-password">
                                                </div>

                                                <div class="form-group">
                                                    <label for="confirm_password"
                                                        class=" col-form-label text-md-right">{{ __('confirm Password') }}</label>
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password_confirmation" required autocomplete="new-password">
                                                </div>

                                                <div class="form-group mb-0">
                                                    <div class="text-center mt-3">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Reset Password') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>

                                    </div><!-- End Bordered Tabs -->

                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>
        </section>

    </section>
@endsection
