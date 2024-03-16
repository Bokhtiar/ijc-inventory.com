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
        'pageTitle' => 'Dashboard',
        'anotherPageIcon' => 'bi bi-plus',
        'anotherPageUrl' => 'admin.dashboard',
    ])
    @endcomponent

    <div class="shadow px-4 py-4 bg-white">
        <h3> {{ @$edit ? 'Update' : 'Create' }} Employee</h3>
        @if (@$edit)
            <form action="@route('admin.employee.update', @$edit->id)" method="post">
                @method('PUT')
            @else
                <form action="@route('admin.employee.store')" method="POST">
        @endif
        @csrf
        <div class="row">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-2">
                <input required class="form-control" type="text" name="name" placeholder="Employee Name" value="{{ @$edit->name }}" id="">
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-2">
                <input required class="form-control" type="email" name="email" placeholder="Employee email" value="{{ @$edit->email }}" id="">
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-2">
                <input required class="form-control" type="number" name="phone" placeholder="Employee phone" value="{{ @$edit->phone }}" id="">
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 my-2">
                <input required class="form-control" type="text" name="password" placeholder="Employee password" value="{{ @$edit->password_text }}" id="">
            </div>
            <div class="my-2 text-center">
                <input type="submit" name="" value="Create Employee" class="btn btn btn-success" id="">
            </div>
        </div>
        </form>
    </div>
@endsection
