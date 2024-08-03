@if($errors->any())
<div class="alert alert-danger">
    <ul>
@foreach($errors->all() as $e)
        <li>{{ $e }}</li>
@endforeach
    </ul>
</div>
@endif

@if(session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
    <ol class="panel-group dd-list" id="fields">
       
            @include('admin.forms.includes.fields', ['fields' => $fields ?? []])
          
    </ol>
    <div class="form-group mt-4">
       

            {!! Form::button('Add Field', [
                'class' => 'btn btn-success',
                'data-container' => 'fields',
                'data-types' => collect(config('field_types'))->map(function($v, $id) {
                    $v = trans("admin.{$v}");
                    return compact('id', 'v');
                })->values()->toJson(),
                'data-has-options' => collect(config('field_types'))->flip()->only(['select', 'checkbox', 'radio'])->values()->toJson(),
                'data-langs' => collect(config('app.locales'))->map(function($v, $id) {
                    return compact('id', 'v');
                })->values()->toJson(),

                'id' => 'add',

            ]) !!}
       
    </div>
