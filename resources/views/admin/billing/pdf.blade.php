<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <section style="margin-left: 50px; margin-right: 25px;">
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


        <div style="margin-top: 15%;">

            <div style="width: 100%;">
                <h3 style="text-align: center; margin-bottom:1px">INVOICE</h3>
            </div>

            <table style="width:100%; ">

                <tr>
                    <th style="font-size: 14px; height:20px; width: 5%">SL.No.</th>
                    <th style="font-size: 14px; height:20px; width: 35%;">Description of Services</th>
                    <th style="font-size: 14px; height:20px; width: 10%">Govt. Fees</th>
                    <th style="font-size: 14px; height:20px; width: 10%">Other Receiptable Expenses</th>
                    <th style="font-size: 14px; height:20px; width: 10%">Professional fees</th>
                    <th style="font-size: 14px; height:20px; width: 10%">VAT</th>
                    <th style="font-size: 14px; height:20px; width: 10%">Tax</th>
                    <th style="font-size: 14px; height:20px; width: 10%">Grand Total</th>
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
                        <td style="font-size: 14px; height:20px; width: 5% ">{{ $loop->index + 1 }}</td>
                        <td style="font-size: 14px; height:20px; width: 25%; text-align: left;">
                            {{ $item->description_service }}
                        </td>
                        <td style="font-size: 14px; height:20px; width: 10% ">{{ $item->govt_fees }}</td>
                        <td style="font-size: 14px; height:20px; width: 10% ">{{ $item->others_expenses }}</td>
                        <td style="font-size: 14px; height:20px; width: 10% ">{{ $item->professional_fees }}
                        </td>
                        <td style="font-size: 14px; height:20px; width: 10% ">{{ $item->tax }}</td>
                        <td style="font-size: 14px; height:20px; width: 10% ">{{ $item->vat }}</td>
                        <td style="font-size: 14px; height:20px; width: 20% ">{{ $item->grand_total }}</td>


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
                        style="text-align: left; font-weight: 900; font-size: 15px; height:20px; width: 40% ">Total
                        Amount</td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">{{ $govt_fees }}</td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">{{ $others_expenses }}</td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">{{ $professional_fees }}</td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">{{ $tax }}</td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">{{ $vat }}</td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">{{ $grand_total }}</td>
                </tr>

                <tr>
                    <td colspan="8" style="text-align: left;font-weight: 900; font-size: 15px; height:20px;">Amount
                        in words:
                        {{ App\Models\Service::numberToWordConvert($grand_total) }}</td>
                </tr>
            </table>
        </div>

        <!-- bank details -->


        {{-- bank detais --}}
        <div style="width: 100%">

            <div style="width: 100%; margin-top:20px">
                <h3 style=" margin-bottom:6px;">Bank Details</h3>
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



        <div style="display: flex;">
            <div style=" margin-top: 22%;">
                <p style="width: 550px; font-weight: normal;">
                    <strong>{{ $billings->bill_creator }}</strong> <br>
                    <span>{{ $billings->biller_designation }}</span> 
                    <div style="margin-top: -7px">
                    <strong> Islam Jahid & Co.</strong> <br>
                    <span> Chartered Accountants</span>
                    </div>
                </p> 
            </div>
        </div>

    </section>
</body>


</html>
