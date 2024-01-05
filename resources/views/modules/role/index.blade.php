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

    <section class="section dashboard">
        <div class="bg-white p-3 rounded shadow">
            <!-- Table with stripped rows -->
            <div class="row">
                <div class="col-md-8 col-lg-8 col-sm-12">
                    <section class="section">
                        <div class="row">
                            <div class="col-lg-12">

                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Index</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($roles as $role)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }} </th>
                                                <td>{{ $role->name }} </td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="@route('role.edit', $role->id)"><i
                                                            class="bi bi-pen"></i></a>
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </section>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Role {{ @$edit ? 'Update' : 'Create' }}</h5>

                            <!--Role Form-->
                            @if (@$edit)
                                <form class="row g-3" method="POST" action="@route('role.update', $edit->id)">
                                    @method('put')
                                @else
                                    <form class="row g-3" method="POST" action="@route('role.store')">
                            @endif
                            @csrf
                        <div class="form-group">
                            <label for="">Role Name</label>
                            <input class="form-control" value="{{ @$edit->name }}" type="text" name="name" id="">
                        </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                            </form><!-- category Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Table with stripped rows -->
        </div>
    </section>




@endsection
