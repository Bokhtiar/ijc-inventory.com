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
        'anotherPageIcon' => 'bi bi-list',
        'anotherPageUrl' => 'permission.index',
    ])
    @endcomponent

    <section class="section dashboard">
        <div class="bg-white p-3 rounded shadow">
            <form action="@route('permission.update', $permission->id)" method="POST">
                @method('put')
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select disabled name="role_id" class="form-control">
                                <option value="">Please select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if ($role->id === $permission->role_id) selected @endif>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="col-md-8">
                        <table class="table responsive-table-input-matrix">
                            <thead>
                                <tr>
                                    <th>Permission</th>
                                    <th>Add</th>
                                    <th>Edit</th>
                                    <th>View</th>
                                    <th>Delete</th>
                                    <th>List</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- role start --}}
                                <tr>
                                    <td>Roles</td>
                                    <td>
                                        <input type="checkbox" name="permission[role][add]"
                                            @isset($permission['permission']['role']['add']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[role][edit]"
                                            @isset($permission['permission']['role']['edit']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[role][view]"
                                            @isset($permission['permission']['role']['view']) checked @endisset value="1">

                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[role][delete]"
                                            @isset($permission['permission']['role']['delete']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[role][list]"
                                            @isset($permission['permission']['role']['list']) checked @endisset value="1">
                                    </td>

                                </tr>
                                {{-- role end --}}

                                {{-- permission start --}}
                                <tr>
                                    <td>Permissions</td>
                                    <td>
                                        <input type="checkbox" name="permission[permission][add]"
                                            @isset($permission['permission']['permission']['add']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[permission][edit]" value="1"
                                            @isset($permission['permission']['permission']['edit']) checked @endisset>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[permission][view]" value="1"
                                            @isset($permission['permission']['permission']['view']) checked @endisset>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[permission][delete]"
                                            @isset($permission['permission']['permission']['delete']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[permission][list]"
                                            @isset($permission['permission']['permission']['list']) checked @endisset value="1">
                                    </td>
                                </tr>
                                {{-- permission end --}}

                                {{-- user start --}}
                                <tr>
                                    <td>CHnage password</td>
                                    <td>
                                        <input type="checkbox" name="permission[change_password][list]"
                                            @isset($permission['permission']['change_password']['list']) checked @endisset value="1">
                                    </td>
                                </tr>
                                {{-- user end  --}}


                                <tr>
                                    <td>Report</td>
                                    <td>
                                        <input type="checkbox" name="permission[report][list]"
                                            @isset($permission['permission']['report']['list']) checked @endisset value="1">
                                    </td>

                                </tr>


                                {{-- employee --}}
                                  <tr>
                                    <td>Employee</td>
                                    <td>
                                        <input type="checkbox" name="permission[employee][add]"
                                            @isset($permission['permission']['employee']['add']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[employee][edit]"
                                            @isset($permission['permission']['employee']['edit']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[employee][view]"
                                            @isset($permission['permission']['employee']['view']) checked @endisset value="1">

                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[employee][delete]"
                                            @isset($permission['permission']['employee']['delete']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[employee][list]"
                                            @isset($permission['permission']['employee']['list']) checked @endisset value="1">
                                    </td>

                                </tr>

                                   {{-- customer --}}
                                  <tr>
                                    <td>Customer</td>
                                    <td>
                                        <input type="checkbox" name="permission[customer][add]"
                                            @isset($permission['permission']['customer']['add']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[customer][edit]"
                                            @isset($permission['permission']['customer']['edit']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[customer][view]"
                                            @isset($permission['permission']['customer']['view']) checked @endisset value="1">

                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[customer][delete]"
                                            @isset($permission['permission']['customer']['delete']) checked @endisset value="1">
                                    </td>
                                    <td>
                                        <input type="checkbox" name="permission[customer][list]"
                                            @isset($permission['permission']['customer']['list']) checked @endisset value="1">
                                    </td>

                                </tr>




                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center my-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
@endsection
