<div class="col-md-6">
    <div class="form-group">
        <label for="field_{{ $field->id }}">{{ $field->title }}
            @if ($field->validation['required'] == 1)
                <span style="color: red">*</span>
            @endif
        </label>
        @foreach ($field->data['options'] as $key => $value)

            <div class="form-check">
                <label class="form-check-label" for="field_{{ $field->id }}_{{ $key }}">
                    <input type="radio" class="form-check-input"
                    {{ isset($disabled) && $disabled == true  ? 'disabled' : '' }}
                    name="answers[{{ $field->id }}]"
                    id="field_{{ $field->id }}_{{ $key }}"
                    value="{{ $value }}"
                    {{ !isset($accountAnswers->{$field->id}) && $loop->first ? 'checked' : '' }}
                    {{ isset($accountAnswers->{$field->id}) && $accountAnswers->{$field->id} == $value ? 'checked' : '' }}>
                    {{ $value }}
                </label>
            </div>
        @endforeach
    </div>
</div>
