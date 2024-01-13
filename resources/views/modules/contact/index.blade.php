@extends('layouts.admin.app')
@section('title', $title)
@section('css')
@endsection
@section('admin_content')

    {{-- breadcrumbs --}}
    @component('components.breadcrumbs', [
        'parent' => 'Role',
        'page' => $title,
        'parent_url' => 'dashboard',
    ])
    @endcomponent



    <section class="section dashboard">
        <div class="bg-white p-3 rounded shadow">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">Index</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Mesage</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }} </th>
                            <td>{{ $contact->name }} </td>
                            <td>{{ $contact->email }} </td>
                            <td>{{ $contact->subject }} </td>
                            <td>{{ $contact->message }} </td>
                            <td>
                                @if ($contact->status == 1)
                                <a href="@route('contact.edit', $contact->contact_id)" class="btn btn-success">Seen</a>
                                @else
                                <a href="@route('contact.edit', $contact->contact_id)" class="btn btn-danger">Unseen</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
