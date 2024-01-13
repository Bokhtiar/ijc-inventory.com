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
            <form action="@route('permission.store')" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select required name="role_id" class="form-control">
                                <option value="">Please select a role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
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
                        <table class=" table responsive-table-input-matrix">
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

                                <tr>
                                    <td>Roles</td>
                                    <td><input type="checkbox" name="permission[role][add]" value="1"></td>
                                    <td><input type="checkbox" name="permission[role][edit]" value="1"></td>
                                    <td><input type="checkbox" name="permission[role][view]" value="1"></td>
                                    <td><input type="checkbox" name="permission[role][delete]" value="1"></td>
                                    <td><input type="checkbox" name="permission[role][list]" value="1"></td>
                                </tr>
                                <tr>
                                    <td>Permissions</td>
                                    <td><input type="checkbox" name="permission[permission][add]" value="1"></td>
                                    <td><input type="checkbox" name="permission[permission][edit]" value="1"></td>
                                    <td><input type="checkbox" name="permission[permission][view]" value="1"></td>
                                    <td><input type="checkbox" name="permission[permission][delete]" value="1"></td>
                                    <td><input type="checkbox" name="permission[permission][list]" value="1"></td>
                                </tr>
                                <tr>
                                    <td>Change password</td>
                                    <td><input type="checkbox" name="permission[change_password][list]" value="1"></td>
                                </tr>

                                <tr>
                                    <td>Billing</td>
                                    <td><input type="checkbox" name="permission[billing][add]" value="1"></td>
                                    <td><input type="checkbox" name="permission[billing][edit]" value="1"></td>
                                    <td><input type="checkbox" name="permission[billing][view]" value="1"></td>
                                    <td><input type="checkbox" name="permission[billing][delete]" value="1"></td>

                                    

                                    <td><input type="checkbox" name="permission[billing][list]" value="1"></td>

                                    <td>PDF <input type="checkbox" name="permission[billing][pdf]" value="1"></td>
                                    <td>Print <input type="checkbox" name="permission[billing][print]" value="1"></td>
                                </tr>
                                

                                <tr>
                                    <td>Employee</td>
                                    <td><input type="checkbox" name="permission[employee][add]" value="1"></td>
                                    <td><input type="checkbox" name="permission[employee][edit]" value="1"></td>
                                    <td><input type="checkbox" name="permission[employee][view]" value="1"></td>
                                    <td><input type="checkbox" name="permission[employee][delete]" value="1"></td>
                                    <td><input type="checkbox" name="permission[employee][list]" value="1"></td>
                                </tr>

                                <tr>
                                    <td>Customer</td>
                                    <td><input type="checkbox" name="permission[customer][add]" value="1"></td>
                                    <td><input type="checkbox" name="permission[customer][edit]" value="1"></td>
                                    <td><input type="checkbox" name="permission[customer][view]" value="1"></td>
                                    <td><input type="checkbox" name="permission[customer][delete]" value="1"></td>
                                    <td><input type="checkbox" name="permission[customer][list]" value="1"></td>
                                </tr>

                                <tr>
                                    <td>Report</td>
                                    <td><input type="checkbox" name="permission[report][list]" value="1"></td>
                                </tr>

                                <tr>
                                    <td>Setting</td>
                                    <td></td>
                                    <td><input type="checkbox" name="permission[setting][edit]" value="1"></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="checkbox" name="permission[setting][list]" value="1"></td>
                                </tr>
 

                                <tr>
                                    <td>Contact</td>
                                    <td></td>
                                    <td><input type="checkbox" name="permission[contact][edit]" value="1"></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="checkbox" name="permission[contact][list]" value="1"></td>
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
