<div class="form-group">
    <label for="field_{{ $field->id }}">{{ $field->title }}
        @if ($field->validation['required'] == 1)
            <span style="color: red">*</span>
        @endif
    </label>
    <input type="number" class="form-control"
    {{ $field->validation['required'] == 1 ? 'required' : '' }}
    id="field_{{ $field->id }}"
    name="answers[{{ $field->id }}]"
    placeholder="{{ $field->title }}"
    value="{{ isset($accountAnswers->{$field->id}) ? $accountAnswers->{$field->id} : '' }}"
    {{ isset($disabled) && $disabled == true  ? 'disabled' : '' }}>
    <small class="warning-text"></small>
</div>
@push('scripts')
<script>
    jQuery(function () {
        $("#field_{{ $field->id }}").keyup(function () {
            $(this).removeClass('warning');
            var val = this.value;
            let msg = '';
            if (val.length != 0) {
                var regex = /^[0-9]+$/g;
                if (!regex.test(val)) {
                    msg = 'ველი უნდა შეიცავდეს მხოლოდ ციფრებს';
                }
            }

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
