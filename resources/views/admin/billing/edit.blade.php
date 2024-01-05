{{-- @extends('layouts.admin.app')
@section('title', $title)
@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
@endsection
@section('admin_content') --}}
{{-- 
https://www.mywebtuts.com/blog/laravel-addremove-and-update-multiple-input-fields-dynamically-with-jquery --}}
{{-- <div class="container">
        <form action="" method="POST">
            @csrf
            <table class="table table-bordered" id="dynamicTable">
                <tr>
                    <th>Name</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                @foreach ($services as $service)
                    <tr>
                        <td><input type="text" name="addmore[0][name]" placeholder="Enter your Name" class="form-control" />
                        </td>
                        <td><input type="text" name="addmore[0][qty]" placeholder="Enter your Qty" class="form-control" />
                        </td>
                        <td><input type="text" name="addmore[0][price]" placeholder="Enter your Price"
                                class="form-control" /></td>
                        <td>
                            @if ($loop->index === 0)
                                <button type="button" name="add" id="add" class="btn btn-success">Add
                                    More</button>
                        </td>
                    @else
                        <button type="button" name="add" id="add" class="btn btn-success"
                            onclick="myFunction()">Remove</button></td>
                @endif

                </tr>
                @endforeach
            </table>
            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div> --}}

{{-- <script type="text/javascript">
        var i = 0;

        $("#add").click(function() {
            ++i;
            $("#dynamicTable").append('<tr><td><input type="text" name="addMore[' + i +
                '][name]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="addMore[' +
                i +
                '][qty]" placeholder="Enter your Qty" class="form-control" /></td><td><input type="text" name="addMore[' +
                i +
                '][price]" placeholder="Enter your Price" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
            );
        });

        $(document).on('click', '.remove-tr', function() {
            $(this).parents('tr').remove();
        });

        function myFunction() {
            alert('delete api')
        }
    </script> --}}
{{-- 
   

@endsection --}}



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
                        <div class="float-end">

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
                                <input type="email" class="form-control ml-3" name="email" value="{{ $edit->email }}"
                                    id="">
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
                                <th width="10%" style="font-size: 12px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($services as $service)
                                <tr>
                                    <td><input type="text" name="description_service[]" placeholder="description service"
                                            class="form-control" value="{{ $service->description_service }}" />
                                    </td>
                                    <td><input type="text" name="govt_fees[]" placeholder="govt fees"
                                            class="form-control" value="{{ $service->govt_fees }}" />
                                    </td>
                                    <td><input type="text" name="others_expenses[]" placeholder="others expenses"
                                            class="form-control" value="{{ $service->others_expenses }}" /></td>

                                    <td><input type="text" name="professional_fees[]" placeholder="professional fees"
                                            class="form-control" value="{{ $service->professional_fees }}" />
                                    </td>
                                    <td><input type="text" name="vat[]" placeholder="vat" class="form-control" value="{{ $service->vat }}" />
                                    </td>
                                    <td><input type="text" name="tax[]" placeholder="tax" value="{{ $service->tax }}" class="form-control" />
                                    </td>
                                    <td>
                                        @if ($loop->index === 0)
                                            <button type="button" name="add" id="add"
                                                class="btn btn-success">Add</button>
                                    </td>
                                @else
                                    <button type="button" name="add" id="add" class="btn btn-danger"
                                        onclick="myFunction()">Remove</button></td>
                            @endif

                            </tr>
                            @endforeach --}}
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

            // var count = 1;

            // dynamic_field(count);

            // function dynamic_field(number) {
            //     html = '<tr>';
            //     html += '<td><input required type="text" name="description_service[]" class="form-control" /></td>';
            //     html += '<td><input required type="number" name="govt_fees[]" class="form-control" /></td>';
            //     html += '<td><input required type="number" name="others_expenses[]" class="form-control" /></td>';
            //     html += '<td><input required type="number" name="professional_fees[]" class="form-control" /></td>';
            //     html += '<td><input required type="number" name="vat[]" class="form-control" /></td>';
            //     html += '<td><input required type="number" name="tax[]" class="form-control" /></td>';
            //     if (number > 1) {
            //         html +=
            //             '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
            //         $('tbody').append(html);
            //     } else {
            //         html +=
            //             '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
            //         $('tbody').html(html);
            //     }
            // }

            // $(document).on('click', '#add', function() {
            //     count++;
            //     dynamic_field(count);
            // });

            // $(document).on('click', '.remove', function() {
            //     count--;
            //     $(this).closest("tr").remove();
            // });



          

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
                                <td><input required type="number" value="' + item.tax + '" name="tax[]" class="form-control" /></td>\
                                <td> <span name="add" id="add" class=" add-tr"><i class=" btn btn-outline-success btn-sm  ri-file-add-fill"></i></span>\
                                <span class="remove-tr"><i class=" btn btn-outline-danger btn-sm text- ri-checkbox-indeterminate-fill"></i></sapn></td></tr>')
                    })
                }
            }) //this is ajax end


            //             var i = 0;
            // $("#add").click(function() {
            //     ++i;
            //     $("#dynamicTable").append('<tr>\
            //         <td><input required type="text" name="description_service[]" class="form-control" /></td>\
            //         <td><input required type="number" name="govt_fees[]" class="form-control" /></td>\
            //         <td><input required type="number" name="others_expenses[]" class="form-control" /></td>\
            //         <td><input required type="number" name="professional_fees[]" class="form-control" /></td>\
            //         <td><input required type="number" name="vat[]" class="form-control" /></td>\
            //         <td><input required type="number" name="tax[]" class="form-control" /></td>\
            //         <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'

            //         // <td><input type="text" name="addMore[]" placeholder="Enter your Name" class="form-control" /></td>\
            //         // <td><input type="text" name="addMore[]" placeholder="Enter your Qty" class="form-control" /></td>\
            //         // <td><input type="text" name="addMore[]" placeholder="Enter your Price" class="form-control" /></td>\
            //         // <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
            //     );
            // });

             $(document).on('click', '.add-tr', function() {
              $("#dynamicTable").append('<tr>\
                    <td><input required type="text" name="description_service[]" class="form-control" /></td>\
                    <td><input required type="number" name="govt_fees[]" class="form-control" /></td>\
                    <td><input required type="number" name="others_expenses[]" class="form-control" /></td>\
                    <td><input required type="number" name="professional_fees[]" class="form-control" /></td>\
                    <td><input required type="number" name="vat[]" class="form-control" /></td>\
                    <td><input required type="number" name="tax[]" class="form-control" /></td>\
                    <td><span name="add" id="add" class=" add-tr"><i class=" btn btn-outline-success btn-sm  ri-file-add-fill"></i></span>\
                                <span class="remove-tr"><i class=" btn btn-outline-danger btn-sm text- ri-checkbox-indeterminate-fill"></i></sapn></tr>'

                    // <td><input type="text" name="addMore[]" placeholder="Enter your Name" class="form-control" /></td>\
                    // <td><input type="text" name="addMore[]" placeholder="Enter your Qty" class="form-control" /></td>\
                    // <td><input type="text" name="addMore[]" placeholder="Enter your Price" class="form-control" /></td>\
                    // <td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>'
                );
            });



            $(document).on('click', '.remove-tr', function() {
                $(this).parents('tr').remove();
            });

        });
    </script>

@endsection
