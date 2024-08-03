@foreach($fields as $key => $f)

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="panel-{{ $f->id }}">
                <span>{{ $f->title }}</span>
            </a>
        </h4>
    </div>
    <div id="panel-{{ $f->id }}" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="row form-group">
                <div class="col col-sm-6">

                    <div data-lang-show="#lang-0">
                        <label>field name</label>
                        <input disabled type="text" name="n_fields[{{ $f->id }}][name]" class="form-control name-field"
                            value="{{ $f->title }}">
                    </div>

                </div>
                <div class="col col-sm-6">
                    <label>field type</label>
                    <select disabled class="form-control" name="n_fields[{{ $f->id }}][type_id]">
                        @foreach (config('field_types') as $key => $item)
                        <option value="{{ $key }}" {{ $key == $f->type ? 'selected' : '' }}>{{ trans('admin.'.$item) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="middle" style="padding-right:20px">
                    <div class="switch small-switch" >
                        <input type="hidden" name="n_fields[{{ $f->id }}][validation][required]" value="0">
                        <input disabled type="checkbox" name="n_fields[{{ $f->id }}][validation][required]" value="1" {{ $f->validation['required'] == 1 ? 'checked' : '' }}>
                        <label>სავალდებულო</label>
                    </div>
                </label>
                <label class="middle" style="padding-right:20px">
                    <div class="switch small-switch">
                        <input type="hidden" name="n_fields[{{ $f->id }}][validation][georgian]" value="0">
                        <input disabled type="checkbox" name="n_fields[{{ $f->id }}][validation][georgian]" value="1" {{ $f->validation['georgian'] == 1 ? 'checked' : '' }}>
                        <label>მხოლოდ ქართულად</label>
                    </div>
                </label>
                <label class="middle" style="padding-right:20px">
                    <div class="switch small-switch">
                        <input type="hidden" name="n_fields[{{ $f->id }}][validation][latin]" value="0">
                        <input disabled type="checkbox" name="n_fields[{{ $f->id }}][validation][latin]" value="1" {{ $f->validation['latin'] == 1 ? 'checked' : '' }}>
                        <label>მხოლოდ ლათინურად</label>
                    </div>
                </label>
                <label class="middle">
                    <div class="switch small-switch">
                        <input type="hidden" name="n_fields[{{ $f->id }}][validation][letters]" value="0">
                        <input disabled type="checkbox" name="n_fields[{{ $f->id }}][validation][letters]" value="1" {{ $f->validation['letters'] == 1 ? 'checked' : '' }}>
                        <label>მხოლოდ ასოები</label>
                    </div>
                </label>
            </div>
            @if ($f->data['options'] !== null)
                <div class="opts" data-prefix="n_fields[{{ $f->id }}]">
                    <div class="panel panel-warning">
                        <div class="panel-body">
                            <div class="wrap">
                                @foreach ($f->data['options'] as $key => $item)
                                    <div class="row">

                                        <div class="col col-xs-6" style="padding-bottom:20px">
                                            <input disabled name="n_fields[{{ $f->id }}][options][{{ $key }}]" class="form-control"
                                                style="margin:0;" value="{{ $item }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endforeach
