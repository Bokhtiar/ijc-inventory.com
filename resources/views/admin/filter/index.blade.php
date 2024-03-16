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

    <section class="section dashboard ">
        <div class="bg-white p-3 rounded shadow">
            <div class="d-flex justify-content-between">
                {{-- compnay name --}}
                <form class="row g-3" action="@route('admin.filter.company_name')" method="POST">
                    @csrf
                    <div class="col-auto">
                        <label for="" class="visually-hidden">Company name</label>
                        <input type="text" class="form-control" name="company_name" value="{{ @$company_name }}"
                            placeholder="compnay name">
                    </div>
                    <div class="col-auto d-flex">
                        <button type="submit" class="btn btn-primary mb-3">Search</button>



                    </div>
                </form>

               
                    <form class="row g-3" action="@route('admin.downloadBill.compnay_name_ways')" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-auto">
                            <label for="" class="visually-hidden">Company name</label>
                            <input type="text" hidden class="form-control" name="company_name"
                                value="{{ @$company_name }}" placeholder="compnay name">
                        </div>
                        <div class="col-auto d-flex">
                            <button type="submit" class="btn btn-primary mb-3">Download</button>


                        </div>
                    </form>
                
                {{-- date filter --}}
                <div>
                    <form action="@route('admin.filter.between-date')" class="" method="POST">
                        @csrf
                        <input type="date" name="start_date" id="" value="{{ @$start_date }}">
                        <input type="date" name="end_date" id="" value="{{ @$end_date }}">
                        <input type="submit" value="Submit" name="" id="">
                    </form>
                </div>
            </div>

        </div>


    </section>

    <section class="section dashboard my-5">
        <div class="bg-white p-3 rounded shadow">
            <!-- Table with stripped rows -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Date</th>
                        <th scope="col">Ref</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($billings as $billing)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }} </th>
                            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $billing->date)->format('d/m/Y') }} </td>
                            <td>{{ $billing->ref }} </td>
                            <td>{{ $billing->company_name }} </td>
                            <td>{{ $billing->email }} </td>
                            <td>{{ $billing->created_by ? $billing->createdBy->name : 'ijc_office' }} </td>

                            <td>{{ App\Models\Service::moneyCurrency(App\Models\Billing::service_amount($billing->billing_id)) }}
                                Tk</td>
                            @php
                                $total += App\Models\Billing::service_amount($billing->billing_id);
                            @endphp
                            <td class="">
                                <a class="btn btn-sm btn-success mb-1" href="@route('admin.billing.show', $billing->billing_id)"><i
                                        class="bi bi-eye"></i></a>
                                <a class="btn btn-sm btn-success mb-1" href="@route('admin.billing.print', $billing->billing_id)"><i
                                        class="bi bi-printer"></i></a>
                                {{-- <a class="btn btn-sm btn-danger" href="@route('admin.billing.destroy', $billing->billing_id)"><i class="bi bi-trash"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan=""></td>
                        <td colspan=""></td>
                        <td colspan=""></td>
                        <td colspan=""></td>
                        <th colspan="" style="font: bold">Total Amount:</th>
                        <th colspan="" style="font: bold"> {{ App\Models\Service::moneyCurrency($total) }} Tk</th>
                        <td colspan=""></td>
                    </tr>
                </tbody>
            </table>
            <!-- End Table with stripped rows -->
        </div>
    </section>


@endsection
