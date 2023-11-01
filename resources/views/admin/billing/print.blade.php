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
            <section class="">
                <div class="d-flex justify-content-between">
                    <h3>{{ $title }}</h3>
                    <a href="@route('admin.billing.pdf', $billings->billing_id)" class="btn btn-success">Dwonload</a>
                </div>


                <section class="" style="margin-left: 70px; margin-right: 35px;">
                    <!-- ref -->
                    <div style="font-weight: 600; margin-top: 80px;">
                        Ref: {{ $billings->ref }}
                    </div>

                    <section style=" margin-top: 30px; margin-bottom: 80px;">
                        <div style="float: left;">
                            <p style="width: 300px;">
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
                                    Date:{{ Carbon\Carbon::createFromFormat('Y-m-d', $billings->date)->format('d/m/Y') }}
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
                                    @if ($billings->website)
                                        Website: {{ $billings->website }}
                                    @endif
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
                            text-align: center;
                        }

                        table,
                        th,
                        td {
                            border: 1px solid black;
                            border-collapse: collapse;
                        }
                    </style>


                    <div style="margin-top: 25%;">
                        <div style="">
                            <h3 style="margin-left: 43%; margin-bottom:1px; font-weight:600">INVOICE</h3>
                        </div>

                        <table style="width:100%; ">

                            <tr>
                                <th style="font-size: 13px; height:25px; width: 5%">SL.No.</th>
                                <th style="font-size: 13px; height:25px; width: 35%;">Description of Services</th>
                                <th style="font-size: 13px; height:25px; width: 10%">Govt. Fees</th>
                                <th style="font-size: 13px; height:25px; width: 10%">Other Receiptable Expenses</th>
                                <th style="font-size: 13px; height:25px; width: 10%">Professional fees</th>
                                <th style="font-size: 13px; height:25px; width: 10%">VAT</th>
                                <th style="font-size: 13px; height:25px; width: 10%">Tax</th>
                                <th style="font-size: 13px; height:25px; width: 10%">Grand Total</th>
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
                                    <td style="font-size: 13px; height:25px; width: 5% ">{{ $loop->index + 1 }}</td>
                                    <td style="font-size: 13px; height:25px; width: 35%; text-align: left;">
                                        {{ $item->description_service }}
                                    </td>
                                    <td style="font-size: 13px; height:25px; width: 10% ">{{ $item->govt_fees }}</td>
                                    <td style="font-size: 13px; height:25px; width: 10% ">{{ $item->others_expenses }}</td>
                                    <td style="font-size: 13px; height:25px; width: 10% ">{{ $item->professional_fees }}
                                    </td>
                                    <td style="font-size: 13px; height:25px; width: 10% ">{{ $item->tax }}</td>
                                    <td style="font-size: 13px; height:25px; width: 10% ">{{ $item->vat }}</td>
                                    <td style="font-size: 13px; height:25px; width: 10% ">{{ $item->grand_total }}</td>


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
                                <td colspan="2"
                                    style="text-align: left; font-weight: 900; font-size: 14px; height:25px; width: 40% ">
                                    Total
                                    Amount</td>
                                <td style="font-size: 13px; height:25px; width: 10%;font-weight: 900; ">{{ $govt_fees }}</td>
                                <td style="font-size: 13px; height:25px; width: 10%;font-weight: 900; ">{{ $others_expenses }}</td>
                                <td style="font-size: 13px; height:25px; width: 10%;font-weight: 900; ">{{ $professional_fees }}</td>
                                <td style="font-size: 13px; height:25px; width: 10%;font-weight: 900; ">{{ $tax }}</td>
                                <td style="font-size: 13px; height:25px; width: 10%;font-weight: 900; ">{{ $vat }}</td>
                                <td style="font-size: 13px; height:25px; width: 10%;font-weight: 900; ">{{ $grand_total }}</td>
                            </tr>

                            <tr>
                                <td colspan="8" style="text-align: left;font-weight: 900; font-size: 14px; height:25px;">
                                    Amount in words:
                                    {{ App\Models\Service::numberToWordConvert($grand_total) }}</td>
                            </tr>
                        </table>
                    </div>

                    <!-- bank details -->


                    {{-- bank detais --}}
                    <div style="width: 100%">

                        <div style="width: 100%; margin-top:20px">
                            <h3 style=" margin-bottom:6px; font-weight:600">Bank Details:</h3>
                        </div>

                        <div class="">
                            <div style="float: left;">
                                <div style=" font-weight: normal; display:flex">
                                    <div style="width: 25px"><strong>01. </strong></div>
                                    <div>
                                        <span> {{ $billings->account_name_1 }}</span><br>
                                        <span>A/C No: {{ $billings->account_number_1 }}</span><br>
                                        <span>Swift Code: {{ $billings->swift_code_1 }}</span> <br>
                                        <span>Routing No: {{ $billings->account_routing_no_1 }}</span><br>
                                        <span style="font-weight: 600;">{{ $billings->bank_name_1 }}</span><br>
                                        <span>{{ $billings->branch_name_1 }}</span>
                                    </div>
                                </div>
                            </div>


                            <div style="float: right;">
                                <div style="float: right;">
                                    <div style="font-weight: normal; display:flex">
                                        <div style="width: 25px"><strong>02. </strong></div>
                                        <div>
                                            <span> {{ $billings->account_name_2 }}</span><br>
                                            <span>A/C No: {{ $billings->account_number_2 }}</span><br>
                                            <span>Swift Code: {{ $billings->swift_code_2 }}</span> <br>
                                            <span>Routing No: {{ $billings->account_routing_no_2 }}</span><br>
                                            <span style="font-weight: 600;">{{ $billings->bank_name_2 }}</span><br>
                                            <span>{{ $billings->branch_name_2 }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div style="">
                        <div style=" margin-top: 20%;">
                            <p style="width: 250px; font-weight: normal; margin-bottom: 11px;">
                                <strong>{{ $billings->bill_creator }}</strong> <br>
                                <span>{{ $billings->biller_designation }}</span> 
                                <p>
                                    <strong> Islam Jahid & Co.</strong> <br> <span> Chartered Accountants</span>
                                </p>
                            </p>
                        </div>
                    </div>
                </section>
            </section>
            <!-- End Table with stripped rows -->
        </div>
    </section>




@endsection
