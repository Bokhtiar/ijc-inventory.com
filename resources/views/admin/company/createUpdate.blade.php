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
        <h3> {{ @$edit ? 'Update' : 'Create' }} Company</h3>
        @if (@$edit)
            <form action="@route('admin.company.update', @$edit->company_id)" method="post">
                @method('PUT')
            @else
                <form action="@route('admin.company.store')" method="POST">
        @endif
        @csrf
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-2">
                <input required class="form-control" type="text" name="name" placeholder="Name"
                    value="{{ @$edit->name }}" id="">
            </div>

            <div class="my-2 text-center">
                @if (@$edit)
                    <input type="submit"  value="Update company" class="btn btn btn-success" id="">
                    @else
                         <input type="submit"  value="Create company" class="btn btn btn-success" id="">
                @endif

               
            </div>
        </div>
        </form>
    </div>
@endsection
