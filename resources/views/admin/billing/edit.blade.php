@extends('layouts.admin.app')
@section('title', $title)
@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endsection
@section('admin_content')


    {{-- breadcrumbs --}}
    @component('components.breadcrumbs', [
        'parent' => 'Home',
        'page' => $title,
        'parent_url' => 'admin.dashboard',
    ])
    @endcomponent


    <section class="">
        <div class="shadow px-4 py-4 bg-white">
            <form action="@route('admin.billing.update', $edit->billing_id)" method="POST">
                @csrf
                @php
                    $today = Carbon\Carbon::now();
                    $currentYear = $today->year;
                    $lastTowDigit = str_split($currentYear);
                @endphp
                {{-- refence --}}
                <div class="d-flex ">
                    <div class="my-auto fw-bold">Ref.....</div>
                    <input disabled required type="text" class="form-control ml-3" value="{{ $edit->ref }}" name="ref"
                        id="">
                </div>

                {{-- heading --}}
                <div class="row mt-3">
                    {{-- address --}}
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5">
                        <input type="text" class="form-control mt-2" placeholder="type here designation"
                            name="designation" value="{{ $edit->designation }}" id="">
                        <input type="text" class="form-control mt-2" placeholder="type here company name"
                            name="company_name" value="{{ $edit->company_name }}" id="">
                        <textarea required class="form-control mt-2" placeholder="type here company location" name="company_location"
                            id="" cols="3" rows="2">{{ $edit->company_location }}</textarea>

                        {{-- att --}}
                        <div class="d-flex mt-3">
                            <div class="my-auto fw-bold">Att...</div>
                            <input required type="text" class="form-control ml-3" value="{{ $edit->att }}"
                                name="att" id="">
                        </div>
                    </div>

                    {{-- contact information --}}
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7 ">
                        <div class="">

                            {{-- date --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Date.</div>
                                <input required type="date" class="form-control ml-3" name="date"
                                    value="{{ $edit->date }}" id="">
                            </div>

                            {{-- cell_no --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Cell.</div>
                                <input required class="form-control" type="number" name="cell_no"
                                    value="{!! $edit->cell_no !!}" onKeyPress="if(this.value.length==11) return false;"
                                    min="0">
                            </div>

                            {{-- telephone --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Telephone.</div>
                                <input class="form-control" type="text" name="telephone" value="{!! $edit->telephone !!}">
                            </div>

                            {{-- email --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Email.</div>
                                <input type="email" required class="form-control ml-3" value="{!! $edit->email !!}" name="email" id="">
                            </div>

                            {{-- website --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Website.</div>
                                <input type="text" class="form-control ml-3" name="website" value="{{ $edit->website }}"
                                    id="">
                            </div>

                        </div>
                    </div>
                </div>

                {{-- https://www.webslesson.info/2019/04/dynamically-add-remove-input-fields-in-laravel-58-using-jquery-ajax.html --}}
                {{-- form --}}
                <h3 class="fw-bolder text-center mt-5 mb-2">INVOICE</h3>
                <input type="text" class="form-control mb-1" placeholder="type here" value="{{ $edit->note }}" name="note" id="">
                <div id="dynamic_form">
                    <span id="result"></span>
                    <table class="table table-bordered" id="dynamicTable">
                        <thead>
                            <tr>
                                <th width="25%" style="font-size: 12px">Description of Services</th>
                                <th width="10%" style="font-size: 12px">Govt. Fees</th>
                                <th width="10%" style="font-size: 12px">Other Receptable Expenses</th>
                                <th width="10%" style="font-size: 12px">Professional Fees</th>
                                <th width="10%" style="font-size: 12px">VAT</th>
                                <th width="10%" style="font-size: 12px">Tax</th>
                                <th width="10%" style="font-size: 12px">Action
                                    <span name="add" id="add" class=""><i
                                            class=" btn btn-outline-success btn-sm  ri-file-add-fill"></i></span>
                                    {{-- <button type="button" name="add" id="add" class="btn btn-success">Add More</button> --}}
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>


                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <input type="text" class="form-control" placeholder="Less advance" name="less_advance"
                            id="" value="{{ $edit->less_advance }}">
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <input type="text" class="form-control" placeholder="Foreign company" name="foreign_company"
                            id="" value="{{ $edit->foreign_company }}">
                    </div>
                </div>

                {{-- footer --}}
                <div class="row mt-5 mb-2">
                    <div class="col-sm-12 col-lg-6 col-md-6">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input required type="text" class="form-control mt-2" placeholder="Bill creator name"
                                name="bill_creator" value="{{ $edit->bill_creator }}" id="">
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input required type="text" class="form-control mt-2"
                                placeholder="Bill creator designation" name="biller_designation"
                                value="{{ $edit->biller_designation }}" id="">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="" value="{{ $edit->billing_id }}" id="purchase_id">

                <div class="text-center">
                    <input required type="Submit" class="btn btn-success" value="Generate invoice" name=""
                        id="">
                </div>
            </form>
        </div>
    </section>


    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var id = $('#purchase_id').val();
            console.log("id", id);
            $.ajax({
                url: '/admin/billing-ways-service/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $.each(response.services, function(key, item) {
                        $('#dynamicTable').append('<tr>\
                                            <td><input required type="text" value="' + item.description_service + '" name="description_service[]" class="form-control" /></td>\
                                            <td><input required type="number" value="' + item.govt_fees + '" name="govt_fees[]" class="form-control" /></td>\
                                            <td><input required type="number" value="' + item.others_expenses + '" name="others_expenses[]" class="form-control" /></td>\
                                            <td><input required type="number" value="' + item.professional_fees + '" name="professional_fees[]" class="form-control" /></td>\
                                            <td><input required type="number" value="' + item.vat + '" name="vat[]" class="form-control" /></td>\
                                            <td><input required type="number" value="' + item.tax +
                            '" name="tax[]" class="form-control" /></td>\
                                            <td> <span name="add" id="add" class=" add-tr"><i class=" btn btn-outline-success btn-sm  ri-file-add-fill"></i></span>\
                                            <span class="remove-tr"><i class=" btn btn-outline-danger btn-sm text- ri-checkbox-indeterminate-fill"></i></sapn></td></tr>'
                        )
                    })
                }
            })


            var i = 0;

            $(document).on('click', '.add-tr', function() {
                $("#dynamicTable").append(
                    '<tr>\
                                <td><input required type="text" name="description_service[]" class="form-control" /></td>\
                                <td><input required type="number" name="govt_fees[]" class="form-control" /></td>\
                                <td><input required type="number" name="others_expenses[]" class="form-control" /></td>\
                                <td><input required type="number" name="professional_fees[]" class="form-control" /></td>\
                                <td><input required type="number" name="vat[]" class="form-control" /></td>\
                                <td><input required type="number" name="tax[]" class="form-control" /></td>\
                                <td><span name="add" id="add" class=" add-tr"><i class=" btn btn-outline-success btn-sm  ri-file-add-fill"></i></span>\
                                            <span class="remove-tr"><i class=" btn btn-outline-danger btn-sm text- ri-checkbox-indeterminate-fill"></i></sapn></tr>'
                );
            });

            $("#add").click(function() {
                ++i;
                $("#dynamicTable").append(
                    '<tr>\
                            <td><input required type="text" name="description_service[]" class="form-control" /></td>\
                            <td><input required type="number" name="govt_fees[]" class="form-control" /></td>\
                            <td><input required type="number" name="others_expenses[]" class="form-control" /></td>\
                            <td><input required type="number" name="professional_fees[]" class="form-control" /></td>\
                            <td><input required type="number" name="vat[]" class="form-control" /></td>\
                            <td><input required type="number" name="tax[]" class="form-control" /></td>\
                            <td><span name="add" id="add" class=" add-tr"><i class=" btn btn-outline-success btn-sm  ri-file-add-fill"></i></span>\
                                        <span class="remove-tr"><i class=" btn btn-outline-danger btn-sm text- ri-checkbox-indeterminate-fill"></i></sapn></tr>'
                );
            });

            $(document).on('click', '.remove-tr', function() {
                $(this).parents('tr').remove();
            });

        });
    </script>

    <script type="text/javascript">
        $('#search').select2({
            placeholder: 'Select an user',
            ajax: {
                url: '/autocomplete/customer/search',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    console.log("data", data);
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.email,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>

@endsection
