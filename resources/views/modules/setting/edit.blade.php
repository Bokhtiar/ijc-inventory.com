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
             <section class="form-group">

                 @if ($errors->any())
                     <div class="alert alert-danger">
                         <ul>
                             @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                             @endforeach
                         </ul>
                     </div>
                 @endif

                 @if (@$edit)
                     <form action="@route('setting.update', $edit->setting_id)" method="POST" enctype="multipart/form-data">
                         @method('PUT')
                 @endif
                 @csrf
                 <section class="row">
                     <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                         <label for="" class="text-muted">Company Name <span class="text-danger">*</span> </label>
                         <input type="text" name="company_name" value="{{ @$edit->company_name }}" class="form-control" required
                             placeholder="it media" id="">
                     </div>

                     <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                         <label for="" class="text-muted">Location <span class="text-danger">*</span>
                         </label>
                         <input type="location" name="location" value="{{ @$edit->location }}" class="form-control" required
                             placeholder="" id="">
                     </div>

                     <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                         <label for="" class="text-muted">Phone <span class="text-danger">*</span>
                         </label>
                         <input type="number" name="phone" value="{{ @$edit->phone }}" class="form-control" required
                             placeholder="" id="">
                     </div>

                     <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                         <label for="" class="text-muted">Working Time </label>
                         <input type="text" name="work_time" value="{{ @$edit->work_time }}" class="form-control"
                             placeholder="" id="">
                     </div>

                    
                     <div class="col-12 col-sm-12 col-md-6 col-lg-6 my-1">
                         <label for="" class="text-muted">Logo </label>
                         <input type="file" name="logo" class="form-control" placeholder="" id="">
                         @if (@$edit->logo)
                             <img src="{{ asset($edit->logo) }}" height="100" width="100" alt="">
                         @endif
                     </div>

                     <div class="text-center mt-1">
                         <button class="btn btn-sm btn-success" type="submit">Submit</button>
                     </div>

                 </section>
                 </form>
             </section>
         </div>
     </section>
 @endsection
