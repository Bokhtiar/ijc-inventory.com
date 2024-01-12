 @extends('layouts.admin.app')
 @section('title', $title)
 @section('css')
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

     <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
     <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
     <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
     <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
 @endsection
 @section('admin_content')


     {{-- breadcrumbs --}}
     @component('components.breadcrumbs', [
         'parent' => 'Home',
         'page' => $title,
         'parent_url' => 'dashboard',
     ])
     @endcomponent


     @if ($type == "filter")
     <div class="shadow mb-3 py-3 pt-4 px-4 bg-white rounded">
        <div class="d-flex justify-content-between">
            <p>Bill Download Excel Date filter</p>
            <form action="@route('export-bill')" method="POST">
                @csrf
                <input type="text" name="daterange" value="" class="" />
                <input type="submit" value="Submit" class=" " style="background-color: green; color: white; border-color:green; border-radius: 5px" name="">
            </form>
        </div>
    </div>
    @endif

     <div class="shadow mb-3 py-3 pt-4 px-4 bg-white rounded">
         <div class="d-flex justify-content-between">
             <p class=" text-uppercase">{{ $type }} Billing Report</p>
             <div class="d-flex">
                 <a href="@route('report.index', 'today')" class="px-1"><span class="{{ $type == "today" ? 'badge bg-success px-4' : 'badge bg-secondary px-4' }}"><i class="ri-arrow-right-up-fill"></i> Today</span></a>
                 <a href="@route('report.index', 'week')" class="px-1"><span class="{{ $type == "week" ? 'badge bg-success px-4' : 'badge bg-secondary px-4' }}"><i class="ri-arrow-right-up-fill"></i>Week</span></a>
                 <a href="@route('report.index', 'month')" class="px-1"><span class="{{ $type == "month" ? 'badge bg-success px-4' : 'badge bg-secondary px-4' }}"><i class="ri-arrow-right-up-fill"></i> Month</span></a>
                 <a href="@route('report.index', 'year')" class="px-1"><span class="{{ $type == "year" ? 'badge bg-success px-4' : 'badge bg-secondary px-4' }}"><i class="ri-arrow-right-up-fill"></i> Year</span></a>
                 <a href="@route('report.index', 'filter')" class="px-1 "><span class="{{ $type == "filter" ? 'badge bg-success px-4' : 'badge bg-secondary px-4' }}"><i class="ri-arrow-right-up-fill"></i> Filter</span></a>
             </div>
         </div>
     </div>


     <section class="section dashboard">
         <div class="bg-white p-3 rounded shadow">
             <!-- Table with stripped rows -->
             <table class="table datatable">
                 <thead>
                     <tr>
                         <th scope="col">Index</th>
                         <th scope="col">Date</th>
                         <th scope="col">Ref</th>
                         <th scope="col">Telephone</th>
                         <th scope="col">Email</th>
                         <th scope="col">Cell No</th>
                         <th scope="col">Action</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($billings as $billing)
                         <tr>
                             <th scope="row">{{ $loop->index + 1 }} </th>
                             <td>{{ Carbon\Carbon::createFromFormat('Y-m-d', $billing->date)->format('d/m/Y') }} </td>
                             <td>{{ $billing->ref }} </td>
                             <td>{{ $billing->telephone }} </td>
                             <td>{{ $billing->user ? $billing->user->email : '' }} </td>
                             <td>{{ $billing->cell_no }} </td>
                             <td>
                                 <a class="btn btn-sm btn-success mt-1" href="@route('billing.show', $billing->billing_id)"><i
                                         class="bi bi-eye"></i></a>
                                 <a class="btn btn-sm btn-success mt-1" href="@route('billing.print', $billing->billing_id)"><i
                                         class="bi bi-printer"></i></a>
                                 <a class="btn btn-sm btn-info mt-1" href="@route('billing.edit', $billing->billing_id)"><i class="bi bi-pen"></i></a>
                                 <a class="btn btn-sm btn-danger mt-1" href="@route('billing.trash', $billing->billing_id)"><i
                                         class="bi bi-trash"></i></a>
                                 {{-- <form action="@route('admin.billing.trash', $billing->billing_id)" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit"><i
                                        class="bi bi-trash"></i></button>
                            </form><!--delete--> --}}
                             </td>
                         </tr>
                     @endforeach
                 </tbody>
             </table>
             <!-- End Table with stripped rows -->
         </div>
     </section>

 @section('js')
     <script>
         $(function() {
             $('input[name="daterange"]').daterangepicker({
                 opens: 'left'
             }, function(start, end, label) {
                 console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                     .format('YYYY-MM-DD'));
             });
         });
     </script>
 @endsection
@endsection
