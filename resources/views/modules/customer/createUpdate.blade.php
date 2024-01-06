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
        'anotherPageUrl' => 'customer.index',
    ])
    @endcomponent

    <section class="section dashboard">
        <div class="bg-white p-3 rounded shadow">
            <section class="form-group">
                @if (@$edit)
                    <form action="@route('customer.update', $edit->id)" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                    @else
                    <form action="@route('customer.store')" method="POST" enctype="multipart/form-data">
                @endif
                @csrf
                <section class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                        <label for="" class="text-muted">Customer Name <span class="text-danger">*</span> </label>
                        <input type="text" name="name" value="{{ @$edit->name }}" class="form-control" required placeholder="Mr.devid albin"
                            id="">
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                        <label for="" class="text-muted">Customer Phone <span class="text-danger">*</span>
                        </label>
                        <input type="number" name="phone" value="{{ @$edit->phone }}" class="form-control" required placeholder="018XXXXXXXXXX"
                            id="">
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                        <label for="" class="text-muted">Customer Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" name="email" value="{{ @$edit->email }}" class="form-control" required placeholder="devid@gamil.com"
                            id="">
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                        <label for="" class="text-muted">Customer Designation </label>
                        <input type="text" name="designation" value="{{ @$edit->designation }}" class="form-control" placeholder="Admin" id="">
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                        <label for="" class="text-muted">Customer Join Date</label>
                        <input type="date" name="join_date" value="{{ @$edit->join_date }}" class="form-control" placeholder="" id="">
                    </div>

                

                    @if (!@$edit)
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                        <label for="" class="text-muted">Customer Password <span class="text-danger">*</span>
                        </label>
                        <input type="password" name="password" value="" class="form-control" required placeholder="" id="">
                    </div>
                    @endif
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-1">
                        <label for="" class="text-muted">Customer Address</label>
                        <input type="text" name="address" value="{{ @$edit->address }}" class="form-control"
                            placeholder="New Eskaton, banglamotor, dhaka, bangladesh" id="">
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 my-1">
                        <label for="" class="text-muted">Customer Profile Pic </label>
                        <input type="file" name="profile_pic" class="form-control" placeholder="" id="">
                        @if (@$edit->profile_pic)
                            <img src="{{ asset($edit->profile_pic) }}" height="100" width="100" alt="">
                        @endif
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
