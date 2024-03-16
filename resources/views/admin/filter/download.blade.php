<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
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


    <section class="">
        <div class="">
            <h3>Company Name: {{ $company_name }}</h3>
            <!-- Table with stripped rows -->
            <table class="table"  style="width:100%; " >
                <thead>
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Date</th>
                        <th scope="col">Ref</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Amount</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @php

                        $total = 0;
                    @endphp
                    @foreach ($billings as $billing)
                        <tr>
                            <td scope="row">{{ $loop->index + 1 }} </td>
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
                            
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan=""></td>
                        <td colspan=""></td>
                        <td colspan=""></td>
                        <td colspan=""></td>
                        <td colspan=""></td>
                        <td colspan="" style="font: bold">Total Amount:</td>
                        <td colspan="" style="font: bold"> {{ App\Models\Service::moneyCurrency($total) }} Tk</td>
                    </tr>
                </tbody>
            </table>
            <!-- End Table with stripped rows -->
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
