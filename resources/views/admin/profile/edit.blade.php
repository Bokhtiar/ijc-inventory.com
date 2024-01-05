@extends('layouts.admin.app')
@section('title', $title)
@section('admin_content')


    {{-- breadcrumbs --}}
    @component('components.breadcrumbs', [
        'parent' => 'Home',
        'page' => $title,
        'parent_url' => 'admin.dashboard',
    ])
    @endcomponent

    {{-- page heading --}}
    @component('components.heading', [
        'pageTitle' => 'Profile ',
        'anotherPageIcon' => 'bi bi-plus',
        'anotherPageUrl' => 'admin.dashboard',
    ])
    @endcomponent

    <section class="section dashboard">


        <section class="section dashboard">
            <div class="bg-white p-3 rounded shadow">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="Name" class=" col-form-label text-md-right">{{ __('Name') }}</label>
                            <input id="Name" type="Name" class="form-control @error('Name') is-invalid @enderror"
                                name="old_Name" required autocomplete="new-Name">
                        </div>
                    </div>

                    {{-- password reset --}}
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <form method="POST" action="@route('admin.password-change')">
                            @csrf
                            <div class="form-group">
                                <label for="password" class=" col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="old_password"
                                    required autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label for="password" class=" col-form-label text-md-right">{{ __('New Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password">
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
                </div>
            </div>
        </section>

    </section>
@endsection
