<div class="form-group">
    <label for="field_{{ $field->id }}">{{ $field->title }}
        @if ($field->validation['required'] == 1)
            <span style="color: red">*</span>
        @endif
    </label>
    <input type="file"
        name="answers[{{ $field->id }}]"
        {{ $field->validation['required'] == 1 ? 'required' : '' }}
        class="file-upload-default"
        {{ isset($disabled) && $disabled == true  ? 'disabled' : '' }}

    value="{{ isset($accountAnswers->{$field->id}) ? $accountAnswers->{$field->id} : '' }}">
    <div class="input-group col-xs-12">
      <input type="text" class="form-control file-upload-info" disabled placeholder="{{ $field->title }}"

    value="{{ isset($accountAnswers->{$field->id}) ? $accountAnswers->{$field->id} : '' }}"
    {{ isset($disabled) && $disabled == true  ? 'disabled' : '' }}>
      <span class="input-group-append">

        <button class="file-upload-browse btn btn-primary"
        {{ isset($disabled)  && $disabled == true  ? 'disabled' : '' }} type="button">ატვირთვა</button>
      </span>
    </div>

    <small class="warning-text"></small>
</div>
