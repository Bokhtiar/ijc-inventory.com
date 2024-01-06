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
        'pageTitle' => 'Dashboard',
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
                            <td>{{ $employee->name }} </td>
                            <td>{{ $employee->email }} </td>
                            <td>{{ $employee->phone }} </td>
                            <td>{{ $employee->phone }} </td>
                            <td>
                                <a class="btn btn-sm btn-success mt-1" href="@route('employee.show', $employee->id)"><i class="bi bi-eye"></i></a>
                                <a class="btn btn-sm btn-info mt-1" href="@route('employee.edit', $employee->id)"><i class="bi bi-pen"></i></a>
                                <form action="@route('employee.destroy', $employee->id)" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger mt-1" type="submit"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
