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
        <table class="table datatable">
            <thead>
                <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Date</th>
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
                        <td> {{ $billing->date }} </td>
                        <td>{{ $billing->telephone }} </td>
                        <td>{{ $billing->email }} </td>
                        <td>{{ $billing->cell_no }} </td>
                        <td>
                           

                            <a class="btn btn-sm btn-success" href="@route('admin.billing.show', $billing->billing_id)"><i class="bi bi-eye"></i></a>
                           

                            {{-- <form action="@route('admin.billing.destroy', $billing->billing_id)" method="POST">
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


   

@endsection
