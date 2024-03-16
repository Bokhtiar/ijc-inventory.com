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

    <section class="section dashboard">
        <div class="bg-white p-3 rounded shadow">
            <!-- Table with stripped rows -->
            <table class="table datatable">
                <a class="btn btn-success" href="@route('admin.employee.create')"><i class="px-1">+</i>Create employee</a>
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
                   @foreach ($employees as $item)
                       <tr>
                        <td>{{ $item->index + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>
                            <a class="btn btn-sm btn-info mt-1 mb-1" href="@route('admin.employee.edit', $item->id)"><i class="bi bi-pen"></i></a>
                             <form action="@route('admin.employee.soft-destroy', $item->id)" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" type="submit"><i
                                                class="bi bi-trash"></i></button>
                                    </form>
                        </td>
                       </tr>
                   @endforeach
                </tbody>
            </table>
            <!-- End Table with stripped rows -->
        </div>
    </section>

@endsection
