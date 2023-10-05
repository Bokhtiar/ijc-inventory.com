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



    <section class="section dashboard">
        <div class="bg-white p-3 rounded shadow">
            <!-- Table with stripped rows -->
            <section>
                <div class="d-flex justify-content-between">
                    <h3>{{ $title }}</h3>
                    <a href="@route('admin.billing.pdf', $billings->billing_id)" class="btn btn-success">Dwonload</a>
                </div>
                <!-- ref -->
                <div style="font-weight: 600; margin-top: 80px;">
                    Ref: {{ $billings->ref }}
                </div>

                <section style=" margin-top: 30px; margin-bottom: 80px;">
                    <div style="float: left;">
                        <p style="width: 240px;">
                            {{ $billings->company_name_location }}
                        </p>
                        <!-- att -->
                        <div style="font-weight: 600; margin-top: 15px;">
                            Att: {{ $billings->att }}
                        </div>

                    </div>

                    <div style="float: right;">
                        <div style="float: right;">
                            <span style="font-weight: 600;">
                                Date: {{ $billings->date }}
                            </span> <br>
                            <span style="font-weight: 600;">
                                Cell_no: {{ $billings->cell_no }}
                            </span>
                            <br>
                            <span style="font-weight: 600;">
                                Telephone: {{ $billings->telephone }}
                            </span>
                            <br>
                            <span style="font-weight: 600;">
                                Email: {{ $billings->email }}
                            </span>
                            <br>
                            <span style="font-weight: 600;">
                                Website: {{ $billings->website }}
                            </span>
                        </div>
                    </div>
                </section>

                <!-- table -->
                <!-- <h3 style="float: left; text-align: center; margin-bottom: -1px;">INVOICE</h3> -->
                <style>
                    th,
                    td {
                        border: 1px solid #ddd;
                        padding: 3px;
                        text-align: left;
                    }

                    table,
                    th,
                    td {
                        border: 1px solid black;
                        border-collapse: collapse;
                    }
                </style>


                <div style="margin-top: 30%;">
                    <div style="width: 100%;">
                        <h3 style="text-align: center; margin-bottom:1px; font-weight:600">INVOICE</h3>
                    </div>

                    <table style="width:100%; ">

                        <tr>
                            <th style="font-size: 13px">SL.No.</th>
                            <th style="font-size: 13px">Description of Services</th>
                            <th style="font-size: 13px">Govt. Fees</th>
                            <th style="font-size: 13px">Other Receiptable Expenses</th>
                            <th style="font-size: 13px">Professional fees</th>
                            <th style="font-size: 13px">Vat</th>
                            <th style="font-size: 13px">Tax</th>
                            <th style="font-size: 13px">Grand Total</th>
                        </tr>

                        @php
                            $govt_fees = 0;
                            $others_expenses = 0;
                            $professional_fees = 0;
                            $tax = 0;
                            $vat = 0;
                            $grand_total = 0;
                        @endphp

                        @foreach ($services as $item)
                            <tr>
                                <td style="font-size: 13px; ">{{ $loop->index + 1 }}</td>
                                <td style="font-size: 13px; ">{{ $item->description_service }}</td>
                                <td style="font-size: 13px; ">{{ $item->govt_fees }}</td>
                                <td style="font-size: 13px; ">{{ $item->others_expenses }}</td>
                                <td style="font-size: 13px; ">{{ $item->professional_fees }}</td>
                                <td style="font-size: 13px; ">{{ $item->tax }}</td>
                                <td style="font-size: 13px; ">{{ $item->vat }}</td>
                                <td style="font-size: 13px; ">{{ $item->grand_total }}</td>


                                <td style="display: none">
                                    {{ $govt_fees += $item->govt_fees }}
                                    {{ $others_expenses += $item->others_expenses }}
                                    {{ $professional_fees += $item->professional_fees }}
                                    {{ $tax += $item->tax }}
                                    {{ $vat += $item->vat }}
                                    {{ $grand_total += $item->grand_total }}
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="2" style="font-weight: 600; font-size: 13px">Total Amount</td>
                            <td style="font-size: 13px; ">{{ $govt_fees }}</td>
                            <td style="font-size: 13px; ">{{ $others_expenses }}</td>
                            <td style="font-size: 13px; ">{{ $professional_fees }}</td>
                            <td style="font-size: 13px; ">{{ $tax }}</td>
                            <td style="font-size: 13px; ">{{ $vat }}</td>
                            <td style="font-size: 13px; ">{{ $grand_total }}</td>
                        </tr>

                        <tr>
                            <td colspan="8" style="font-weight: 600; font-size:13px">Total Amount:
                                {{ App\Models\Service::numberToWordConvert(30) }}</td>
                        </tr>
                    </table>
                </div>

                <!-- bank details -->


                {{-- bank detais --}}
                <div style="width: 100%">

                    <div style="width: 100%; margin-top:20px">
                        <h3 style=" margin-bottom:6px; font-weight:600">Bank Details:</h3>
                    </div>

                    <div style="float: left;">
                        <div style=" font-weight: normal;">
                            <span> <strong>01. </strong> {{ $billings->account_name_1 }}</span><br>
                            <span>A/C No: {{ $billings->account_number_1 }}</span><br>
                            <span>Swift Code: {{ $billings->swift_code_1 }}</span> <br>
                            <span>Routing No: {{ $billings->account_routing_no_1 }}</span><br>
                            <span style="font-weight: 600;">{{ $billings->bank_name_1 }}</span><br>
                            <span>{{ $billings->branch_name_1 }}</span>
                        </div>
                    </div>


                    <div style="float: right;">
                        <div style="float: right;">
                            <div style="margin-left: 10px; font-weight: normal;">
                                <span> <strong>02. </strong> {{ $billings->account_name_2 }}</span><br>
                                <span>A/C No: {{ $billings->account_number_2 }}</span><br>
                                <span>Swift Code: {{ $billings->swift_code_2 }}</span> <br>
                                <span>Routing No: {{ $billings->account_routing_no_2 }}</span><br>
                                <span style="font-weight: 600;">{{ $billings->bank_name_2 }}</span><br>
                                <span>{{ $billings->branch_name_2 }}</span>
                            </div>

                        </div>
                    </div>
                </div>



                <div style="">
                    <div style=" margin-top: 30%;">
                        <p style="width: 250px; font-weight: normal;">
                            {{ $billings->footer_about }}
                        </p>
                    </div>
                </div>
            </section>
            <!-- End Table with stripped rows -->
        </div>
    </section>




@endsection
