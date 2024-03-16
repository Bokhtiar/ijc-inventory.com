@extends('layouts.admin.app')
@section('title', $title)
@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
@endsection
@section('admin_content')


    {{-- breadcrumbs --}}
    @component('components.breadcrumbs', [
        'parent' => 'Home',
        'page' => $title,
        'parent_url' => 'admin.dashboard',
    ])
    @endcomponent

    <div class="shadow mb-3 py-3 pt-4 px-4 bg-white rounded">
        <div class="d-flex justify-content-between">
            <p>Download Excel Date filter</p>
            <form action="@route('admin.export-bill')" method="POST">
                @csrf
                <input type="date" name="start_date" id="">
                <input type="date" name="end_date" id="">
                <input type="submit" value="Submit" name="" id="">
            </form>
        </div>
    </div>

    <section class="section dashboard">
        <div class="bg-white p-3 rounded shadow">
            <!-- Table with stripped rows -->
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Date</th>
                        <th scope="col">Ref</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created </th>
                        <th scope="col">Cell No</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($billings as $billing)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }} </th>
                            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $billing->date)->format('d/m/Y') }} </td>
                            <td>{{ $billing->ref }} </td>
                            <td>{{ $billing->company_name }} </td>
                            <td>{{ $billing->email }} </td>
                            <td>{{ $billing->created_by ? $billing->createdBy->name : 'ijc_office' }} </td>
                            <td>{{ $billing->cell_no }} </td>
                            <td class="">
                                <a class="btn btn-sm btn-info text-white mt-1 mb-1" href="@route('admin.billing.restore', $billing->billing_id)"><i
                                        class="ri-arrow-go-back-fill"></i></a>
                                <a class="btn btn-sm btn-info mt-1 mb-1" href="@route('admin.billing.edit', $billing->billing_id)"><i
                                        class="bi bi-pen"></i></a>
                                <a class="btn btn-sm btn-success mb-1" href="@route('admin.billing.show', $billing->billing_id)"><i
                                        class="bi bi-eye"></i></a>
                                <a class="btn btn-sm btn-success mb-1" href="@route('admin.billing.print', $billing->billing_id)"><i
                                        class="bi bi-printer"></i></a>

                                {{-- <a class="btn btn-sm btn-danger" href="@route('admin.billing.destroy', $billing->billing_id)"><i class="bi bi-trash"></i></a> --}}
                                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                <form action="@route('admin.billing.destroy', $billing->billing_id)" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" type="submit"><i
                                            class="bi bi-trash"></i></button>
                                </form><!--delete-->
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Table with stripped rows -->
        </div>
    </section>




@endsection
