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
                <p style="width: 350px;">
                    <strong>To,</strong> <br>
                    <span>{{ $billings->designation }}</span> <br>
                    <strong>{{ $billings->company_name }}</strong> <br>
                    <span style="font-size: 14px">{{ $billings->company_location }}</span>
                </p>
                <!-- att -->
                <div style="font-weight: 600; margin-top: 15px;">
                    Att: {{ $billings->att }}
                </div>
            </div>
            <div style="float: right;">
                <span style="">
                    Date: {{ Carbon\Carbon::createFromFormat('Y-m-d', $billings->date)->format('d/m/Y') }}
                </span> <br>
                <span style="">
                    Cell: {{ $billings->cell_no }}
                </span>
                <br>
                @if ($billings->telephone)
                    <span style="">
                        Telephone: {{ $billings->telephone }}
                    </span>
                    <br>
                @endif
                <span style="">
                    Email: {{ $billings->email }}
                </span>
                <br>
                <span style="">
                    @if ($billings->website)
                        Website: {{ $billings->website }}
                    @endif
                </span>
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
                    $vat = 0;
                    $tax = 0;
                    $grand_total = 0;
                @endphp

                @foreach ($services as $item)
                    <tr>
                        <td style="font-size: 14px; height:20px; width: 5% ">{{ $loop->index + 1 }}</td>
                        <td style="font-size: 14px; height:20px; width: 25%; text-align: left;">
                            {{ $item->description_service }}
                        </td>
                        <td style="font-size: 14px; height:20px; width: 10% ">
                            {{ App\Models\Service::moneyCurrency($item->govt_fees) }}</td>
                        <td style="font-size: 14px; height:20px; width: 10% ">
                            {{ App\Models\Service::moneyCurrency($item->others_expenses) }}</td>
                        <td style="font-size: 14px; height:20px; width: 10% ">
                            {{ App\Models\Service::moneyCurrency($item->professional_fees) }}
                        </td>
                        <td style="font-size: 14px; height:20px; width: 10% ">
                            {{ App\Models\Service::moneyCurrency($item->vat) }}</td>
                        <td style="font-size: 14px; height:20px; width: 10% ">
                            {{ App\Models\Service::moneyCurrency($item->tax) }}</td>

                        <td style="font-size: 14px; height:20px; width: 20% ">
                            {{ App\Models\Service::moneyCurrency($item->grand_total) }}</td>


                        <td style="display: none">
                            {{ $govt_fees += $item->govt_fees }}
                            {{ $others_expenses += $item->others_expenses }}
                            {{ $professional_fees += $item->professional_fees }}
                            {{ $vat += $item->vat }}
                            {{ $tax += $item->tax }}
                            {{ $grand_total += $item->grand_total }}
                        </td>
                    </tr>
                @endforeach

                <tr>
                    <td colspan="2"
                        style="text-align: left; font-weight: 900; font-size: 15px; height:20px; width: 40% ">Total
                        Amount</td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">
                        {{ App\Models\Service::moneyCurrency($govt_fees) }}</td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">
                        {{ App\Models\Service::moneyCurrency($others_expenses) }}</td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">
                        {{ App\Models\Service::moneyCurrency($professional_fees) }}
                    </td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">
                        {{ App\Models\Service::moneyCurrency($vat) }}</td>
                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">
                        {{ App\Models\Service::moneyCurrency($tax) }}</td>

                    <td style="font-size: 14px; height:20px; width: 10%;font-weight: 900; ">
                        {{ App\Models\Service::moneyCurrency($grand_total) }}</td>
                </tr>
                @if ($billings->less_advance)
                    {{-- less advence --}}
                    <tr>
                        <td colspan="2" style="text-align: left;font-weight: 900; font-size: 14px; height:25px;">
                            Less Advence:
                        </td>
                        <td colspan="5">

                        </td>
                        <td>
                            <strong style="font-size: 13px; height:25px; width: 10%;font-weight: 900; ">
                                {{ App\Models\Service::moneyCurrency($billings->less_advance) }}</strong>
                        </td>
                    </tr>

                    {{--  Due amount: --}}
                    <tr>
                        <td colspan="2" style="text-align: left;font-weight: 900; font-size: 14px; height:25px;">
                            Due Amount:
                        </td>
                        <td colspan="5">

                        </td>
                        <td>
                            <strong
                                style="font-size: 13px; height:25px; width: 10%;font-weight: 900; ">{{ App\Models\Service::moneyCurrency($grand_total - $billings->less_advance) }}</strong>
                        </td>
                    </tr>
                    {{-- amount in word --}}
                    <tr>
                        <td colspan="8" style="text-align: left;font-weight: 900; font-size: 14px; height:25px;">
                            Amount In Words:
                            {{ App\Models\Service::numberToWordConvert($grand_total - $billings->less_advance) }} Taka
                            Only
                        </td>
                    </tr>
                @else
                    <tr>
                        <td colspan="8" style="text-align: left;font-weight: 900; font-size: 14px; height:25px;">
                            Amount In Words:
                            {{ App\Models\Service::numberToWordConvert($grand_total) }} Taka Only
                        </td>
                    </tr>
                @endif

            </table>

            <div style="margin-top: 10px">
                @if ($billings->foreign_company)
                    <strong>Foreign Company :</strong> {{ $billings->foreign_company }}
                @endif
            </div>
        </div>

        <!-- bank details -->


        {{-- bank detais --}}
        <div style="width: 100%">

            <div style="width: 100%; margin-top:20px">
                <h3 style=" margin-bottom:6px;">Bank Details</h3>
            </div>

            <div style="float: left;">
                <div style=" font-weight: normal;   flex-wrap: wrap;">
                    <table style="border: none">
                        <td style="border: none"><strong>01. </strong></td>
                        <td style="border: none; text-align: left;">
                            <span>Islam Jahid & Co</span><br>
                            <span>A/C No: 00300210009359</span><br>
                            <span>Swift Code: TTBLBDDH030</span> <br>
                            <span>Routing No: 240262532</span><br>
                            <span style="font-weight: 600;">Trust Bank Ltd.</span><br>
                            <span>Karwan Bazar Branch, Dhaka-1215</span>
                        </td>
                    </table>
                </div>
            </div>


            <div style="float: right;">
                <div style="font-weight: normal;">
                    <table style="border: none">
                        <td style="border: none"><strong>02. </strong></td>
                        <td style="border: none; text-align: left;">
                            <span> Islam Jahid & Co.</span><br>
                            <span>A/C No: 116412200213729</span><br>
                            <span>Swift Code: UTBLBDDH</span> <br>
                            <span>Routing No: 250261699</span><br>
                            <span style="font-weight: 600;">Uttara Bank Ltd.</span><br>
                            <span>Green Road. Branch, Dhaka</span>
                        </td>
                    </table>

                </div>
            </div>
        </div>



        <div style="display: flex;">
            <div style=" margin-top: 26%;">
                <p style="width: 550px; font-weight: normal; margint-top: 35px">
                    <strong>{{ $billings->bill_creator }}</strong> <br>
                    <span>{{ $billings->biller_designation }}</span>
                <div style="margin-top: -11px">
                    <strong> Islam Jahid & Co.</strong> <br>
                    <span> Chartered Accountants</span>
                </div>
                </p>
            </div>
        </div>

    </section>
</body>


</html>
