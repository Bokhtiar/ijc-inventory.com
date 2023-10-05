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
            <form action="@route('admin.billing.store')" method="POST">
                @csrf

                {{-- refence --}}
                <div class="d-flex ">
                    <div class="my-auto fw-bold">Ref.....</div>
                    <input required type="text" class="form-control ml-3" name="ref" id="">
                    <div class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>

                {{-- heading --}}
                <div class="row mt-3">
                    {{-- address --}}
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5">
                        <textarea required class="form-control" placeholder="type here company name with location" name="company_name_location"
                            id="" cols="10" rows="6"></textarea>

                        {{-- att --}}
                        <div class="d-flex mt-3">
                            <div class="my-auto fw-bold">Att...</div>
                            <input required type="text" class="form-control ml-3" name="att" id="">
                        </div>
                    </div>

                    {{-- contact information --}}
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7 ">
                        <div class="float-end">

                            {{-- date --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Date.</div>
                                <input required type="date" class="form-control ml-3" name="date" id="">
                            </div>

                            {{-- cell_no --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Cell_No.</div>
                                <input required type="number" class="form-control ml-3" name="cell_no" id="">
                            </div>

                            {{-- telephone --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Telephone.</div>
                                <input required type="number" class="form-control ml-3" name="telephone" id="">
                            </div>

                            {{-- email --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Email.</div>
                                <input required type="email" class="form-control ml-3" name="email" id="">
                            </div>

                            {{-- website --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Website.</div>
                                <input required type="text" class="form-control ml-3" name="website" id="">
                            </div>

                        </div>
                    </div>
                </div>

                {{-- https://www.webslesson.info/2019/04/dynamically-add-remove-input-fields-in-laravel-58-using-jquery-ajax.html --}}
                {{-- form --}}
                <h3 class="fw-bolder text-center mt-5 mb-2">Invoice</h3>
                <div id="dynamic_form">
                    <span id="result"></span>
                    <table class="table table-bordered " id="user_table">
                        <thead>
                            <tr>
                                <th width="25%" style="font-size: 12px">Description of Services</th>
                                <th width="10%" style="font-size: 12px">Govt. Fees</th>
                                <th width="10%" style="font-size: 12px">Other Receptable Expenses</th>
                                <th width="10%" style="font-size: 12px">Professional Fees</th>
                                <th width="10%" style="font-size: 12px">Tax</th>
                                <th width="10%" style="font-size: 12px">Vat</th>
                                <th width="10%" style="font-size: 12px">Grand Total</th>
                                <th width="10%" style="font-size: 12px">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>
                </div>

                {{-- bank details --}}
                <h5 class="fw-bolder">Bank Details:</h5>
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                        <div class="float-start">
                            <strong>01.</strong>
                            <input required type="text" class="form-control mt-2" placeholder="Account Name"
                                name="account_name_1" id="">
                            <input required type="text" class="form-control mt-2" placeholder="Account Number"
                                name="account_number_1" id="">
                            <input required type="text" class="form-control mt-2" placeholder="Rounting No"
                                name="account_routing_no_1" id="">
                            <input required type="text" class="form-control mt-2" placeholder="Bank Name"
                                name="bank_name_1" id="">
                            <input required type="text" class="form-control mt-2" placeholder="Branch Name"
                                name="branch_name_1" id="">
                        </div>

                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="float-end">
                            <strong>02.</strong>
                            <input required type="text" class="form-control mt-2" placeholder="Account Name"
                                name="account_name_2" id="">
                            <input required type="text" class="form-control mt-2" placeholder="Account Number"
                                name="account_number_2" id="">
                            <input required type="text" class="form-control mt-2" placeholder="Rounting No"
                                name="account_routing_no_2" id="">
                            <input required type="text" class="form-control mt-2" placeholder="Bank Name"
                                name="bank_name_2" id="">
                            <input required type="text" class="form-control mt-2" placeholder="Branch Name"
                                name="branch_name_2" id="">
                        </div>
                    </div>
                </div>

                {{-- footer --}}
                <div class="row my-3">
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <textarea required class="form-control" placeholder="type here your information" name="footer_about" id=""
                            cols="10" rows="6"></textarea>
                    </div>
                </div>

                <div class="text-center">
                    <input required type="Submit" class="btn btn-success" value="Generate invoice" name=""
                        id="">
                </div>
            </form>
        </div>
    </section>


    <script>
        $(document).ready(function() {

            var count = 1;

            dynamic_field(count);

            function dynamic_field(number) {
                html = '<tr>';
                html += '<td><input required type="text" name="description_service[]" class="form-control" /></td>';
                html += '<td><input required type="text" name="govt_fees[]" class="form-control" /></td>';
                html += '<td><input required type="text" name="others_expenses[]" class="form-control" /></td>';
                html += '<td><input required type="text" name="professional_fees[]" class="form-control" /></td>';
                html += '<td><input required type="text" name="tax[]" class="form-control" /></td>';
                html += '<td><input required type="text" name="vat[]" class="form-control" /></td>';
                html += '<td><input required type="text" name="grand_total[]" class="form-control" /></td>';
                if (number > 1) {
                    html +=
                        '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Remove</button></td></tr>';
                    $('tbody').append(html);
                } else {
                    html +=
                        '<td><button type="button" name="add" id="add" class="btn btn-success">Add</button></td></tr>';
                    $('tbody').html(html);
                }
            }

            $(document).on('click', '#add', function() {
                count++;
                dynamic_field(count);
            });

            $(document).on('click', '.remove', function() {
                count--;
                $(this).closest("tr").remove();
            });

            $('#dynamic_form').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: '{{ url('/') }}',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#save').attr('disabled', 'disabled');
                    },
                    success: function(data) {
                        if (data.error) {
                            var error_html = '';
                            for (var count = 0; count < data.error.length; count++) {
                                error_html += '<p>' + data.error[count] + '</p>';
                            }
                            $('#result').html('<div class="alert alert-danger">' + error_html +
                                '</div>');
                        } else {
                            dynamic_field(1);
                            $('#result').html('<div class="alert alert-success">' + data
                                .success + '</div>');
                        }
                        $('#save').attr('disabled', false);
                    }
                })
            });

        });
    </script>

@endsection
