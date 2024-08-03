<div class="form-group">
    <label for="field_{{ $field->id }}">{{ $field->title }}
        @if ($field->validation['required'] == 1)
            <span style="color: red">*</span>
        @endif
    </label>
    <select class="form-control"
        {{ isset($disabled) && $disabled == true  ? 'disabled' : '' }}
        {{ $field->validation['required'] == 1 ? 'required' : '' }}
        id="field_{{ $field->id }}"
        name="answers[{{ $field->id }}]">

        @foreach ($field->data['options'] as $key => $value)
            <option value="{{ $value }}"
            {{ isset($accountAnswers->{$field->id}) && $accountAnswers->{$field->id} == $value ? 'selected' : '' }}
            >{{ $value }}</option>
        @endforeach
    </select>
    <small class="warning-text"></small>
</div>
@push('scripts')
<script>
    jQuery(function () {
        $("#field_{{ $field->id }}").keyup(function () {
            $(this).removeClass('warning');
            var val = this.value;
            let msg = '';
            @if ($field->validation['required'] == 1)
                if (val == '') {
                    $(this).addClass('warning');
                    msg = 'ეს ველი სავალდებულოა';
                }
            @endif
            $(this).siblings('small').text(msg)
        });
    });
</script>
@endpush
