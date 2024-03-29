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
        'anotherPageUrl' => 'employee.create',
    ])
    @endcomponent

    <section class="section dashboard">
        <div class="bg-white p-3 rounded shadow">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employees as $employee)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }} </th>
                            <th>  <img src="{{ asset($employee->profile_pic ? $employee->profile_pic : 'admin/assets/img/avater.jpg') }}"
                                    alt="image" height="40" width="40" class="rounded-circle"></th>
                            <td>{{ $employee->name }} </td>
                            <td>{{ $employee->email }} </td>
                            <td>{{ $employee->phone }} </td>
                            <td>
                                @isset(auth()->user()->role->permission['permission']['employee']['view'])
                                <a class="btn btn-sm btn-success mt-1" href="@route('employee.show', $employee->id)"><i class="bi bi-eye"></i></a>
                                @endisset
                                @isset(auth()->user()->role->permission['permission']['employee']['edit'])
                                <a class="btn btn-sm btn-info mt-1" href="@route('employee.edit', $employee->id)"><i class="bi bi-pen"></i></a>
                                @endisset
                                @isset(auth()->user()->role->permission['permission']['employee']['delete'])
                                <form action="@route('employee.destroy', $employee->id)" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger mt-1" type="submit"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                                @endisset
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
