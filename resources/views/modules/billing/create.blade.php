@extends('layouts.admin.app')
@section('title', $title)
@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
@endsection
@section('admin_content')


    {{-- breadcrumbs --}}
    @component('components.breadcrumbs', [
        'parent' => 'Home',
        'page' => $title,
        'parent_url' => 'dashboard',
    ])
    @endcomponent

    @component('components.heading', [
        'pageTitle' => $title,
        'anotherPageIcon' => 'bi bi-list',
        'anotherPageUrl' => 'billing.list',
    ])
    @endcomponent


    <section class="">
        <div class="shadow px-4 py-4 bg-white">
            <form action="@route('billing.store')" method="POST">
                @csrf
                @php
                    $today = Carbon\Carbon::now();
                    $currentYear = $today->year;
                    $lastTowDigit = str_split($currentYear);
                @endphp
                {{-- refence --}}
                <div class="d-flex ">
                    <div class="my-auto fw-bold">Ref.....</div>
                    <input disabled required type="text" class="form-control ml-3"
                        value="IJC/{{ $lastTowDigit[2] . '' . $lastTowDigit[3] }} /Inv-{{ App\Models\Billing::count() + 1 }}"
                        name="ref" id="">
                </div>

                {{-- heading --}}
                <div class="row mt-3">
                    {{-- address --}}
                    <div class="col-12 col-sm-12 col-md-5 col-lg-5">
                        <input type="text" class="form-control mt-2" placeholder="Type here designation"
                            name="designation" id="">
                        <input type="text" class="form-control mt-2" placeholder="Type here company name"
                            name="company_name" id="">
                        <textarea required class="form-control mt-2" placeholder="Type here company location" name="company_location"
                            id="" cols="3" rows="2"></textarea>

                        {{-- att --}}
                        <div class="d-flex mt-3">
                            <div class="my-auto fw-bold">Att...</div>
                            <input required type="text" class="form-control ml-3" name="att" id="">
                        </div>
                    </div>

                    {{-- contact information --}}
                    <div class="col-12 col-sm-12 col-md-7 col-lg-7 ">
                        <div class="">

                            {{-- date --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Date.</div>
                                <input required type="date" class="form-control ml-3" name="date" id="">
                            </div>

                            {{-- cell_no --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Cell.</div>
                                <input required class="form-control" type="number" placeholder="018XXXXXXXX" name="cell_no"
                                    ng-model="number" onKeyPress="if(this.value.length==11) return false;" min="0">
                            </div>

                            {{-- telephone --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Telephone.</div>
                                <input class="form-control" type="text" name="telephone" placeholder="XXXXXXXXXXXXXX"
                                    ng-model="number">
                            </div>

                            {{-- customer --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Customer.</div>
                                {{-- <input type="email" class="form-control ml-3" placeholder="devide@gmail.com"
                                    name="email" id=""> --}}
                                <select required class="form-control" id="search" style="width:500px;" name="user_id">
                                    {{-- <option value="7">asdads@gmail.com</option> defoult values --}} 
                                </select>
                            </div>



                            {{-- website --}}
                            <div class="d-flex mt-1">
                                <div class="my-auto fw-bold">Website.</div>
                                <input type="text" class="form-control ml-3" placeholder="xyz.com" name="website"
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
                    <table class="table table-bordered " id="user_table">
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
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <input type="text" class="form-control" placeholder="Less advance" name="less_advance"
                            id="">
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <input type="text" class="form-control" placeholder="Foreign company" name="foreign_company"
                            id="">
                    </div>
                </div>

                {{-- footer --}}
                <div class="row mt-5 mb-2">
                    <div class="col-sm-12 col-lg-6 col-md-6">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input required type="text" class="form-control mt-2" placeholder="Bill creator name"
                                name="bill_creator" id="">
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input required type="text" class="form-control mt-2"
                                placeholder="Bill creator designation" name="biller_designation" id="">
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <input required type="Submit" class="btn btn-success" value="Generate bill" name=""
                        id="">
                </div>
            </form>
        </div>
    </section>


    <script>
        $(document).ready(function() {


            // dynamic form
            var count = 1;
            dynamic_field(count);

            function dynamic_field(number) {
                html = '<tr>';
                html += '<td><input required type="text" name="description_service[]" class="form-control" /></td>';
                html += '<td><input required type="number" name="govt_fees[]" class="form-control" /></td>';
                html += '<td><input required type="number" name="others_expenses[]" class="form-control" /></td>';
                html += '<td><input required type="number" name="professional_fees[]" class="form-control" /></td>';
                html += '<td><input required type="number" name="vat[]" class="form-control" /></td>';
                html += '<td><input required type="number" name="tax[]" class="form-control" /></td>';
                if (number > 1) {
                    html +=
                        '<td><span type="button" name="remove" id="" class=" remove"><i class=" btn btn-outline-danger btn-sm text- ri-checkbox-indeterminate-fill"></i></span></td></tr>';
                    $('tbody').append(html);
                } else {
                    html +=
                        '<td><span type="button" name="add" id="add" class=""><i class=" btn btn-outline-success btn-sm  ri-file-add-fill"></i></span></td></tr>';
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
