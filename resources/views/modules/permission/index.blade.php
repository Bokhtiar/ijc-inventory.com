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
        'anotherPageUrl' => 'permission.create',
    ])
    @endcomponent

    <section class="section dashboard">
        <div class="bg-white p-3 rounded shadow">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">Sl</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr> 
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $permission->role ? $permission->role->name : 'Data not found' }}</td>
                            <td>
                                <a class="btn btn-success" href="@route('permission.edit', $permission->id)"><i
                                                            class="bi bi-pen"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
