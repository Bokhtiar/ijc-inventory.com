@extends('layouts.admin.app')
@section('title', $title)

@section('admin_content')


    {{-- breadcrumbs --}}
    @component('components.breadcrumbs', [
        'parent' => 'Home',
        'page' => $title,
        'parent_url' => 'admin.dashboard',
    ])
    @endcomponent

    @component('components.heading', [
        'pageTitle' => "Company create",
        'anotherPageIcon' => 'bi bi-plus',
        'anotherPageUrl' => 'admin.company.create',
    ])
    @endcomponent



    <section class="section dashboard my-5">
        <div class="bg-white p-3 rounded shadow">
            <!-- Table with stripped rows -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Compnay</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($companies as $company)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }} </th>
                            <td>{{ $company->name }} </td>
                            <td>
                                @if ($company->status == 1)
                                    <a href="">Active</a>
                                @else
                                    <a href="">InActive</a>
                                @endif
                            </td>
                            <td class="">
                                <a class="btn btn-sm btn-success mb-1" href="@route('admin.company.edit', $company->company_id)"><i
                                        class="bi bi-pen"></i></a>
                               <form action="@route('admin.company.destroy', $company->company_id)" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-sm btn-danger" type="submit"><i
                                            class="bi bi-trash"></i></button>
                                </form><!--delete-->
                                {{-- <a class="btn btn-sm btn-danger" href="@route('admin.company.destroy', $company->company_id)"><i class="bi bi-trash"></i></a> --}}
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
            <!-- End Table with stripped rows -->
        </div>
    </section>


@endsection