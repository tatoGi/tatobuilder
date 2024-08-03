
@extends('admin.layouts.app')
@push('name')
@endpush
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary table-header-btn" href="/{{ app()->getLocale() }}/admin/forms/create">
                <i class="mdi mdi-plus"></i> Add forms
            </a>
           
            <div class="table-responsive mt-3">
                <table class="table table-striped d-table">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Edit
                            </th>
                            <th>
                               Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($forms as $form)
                      
                        <tr>
                            <td class="py-1">
                                <span >{{ $form->title }}</span>
                            </td>
                            <td>
                                <a href="/{{ app()->getlocale() }}/admin/forms/edit/{{ $form->id }}" class="btn btn-primary table-header-btn uppercase" >
                                    <i class="mdi mdi-pencil"></i> Edit
                                </a>
                                
                            </td>
                            <td>
                                <form method="POST" class="swal-form" style="display: inline" action="/{{ app()->getlocale() }}/admin/forms/destroy/{{ $form->id }}">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="swal-confirm btn btn-danger uppercase"><i class="mdi mdi-delete"></i> Delete</button>
                                </form>
                                @error('delete') <small class="error danger">{{ $errors->first('delete') }}</small> @enderror
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                   
                </table>

               
            </div>
        </div>
    </div>
</div>



@endsection