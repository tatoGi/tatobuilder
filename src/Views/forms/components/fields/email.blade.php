<div class="form-group">
    <label for="field_{{ $field->id }}">{{ $field->title }}
        @if ($field->validation['required'] == 1)
            <span style="color: red">*</span>
        @endif
    </label>
    <input type="email" class="form-control"
    {{ $field->validation['required'] == 1 ? 'required' : '' }}
    id="field_{{ $field->id }}"
    name="answers[{{ $field->id }}]"
    placeholder="{{ $field->title }}"
    value="{{ isset($accountAnswers->{$field->id}) ? $accountAnswers->{$field->id} : '' }}"
    {{ isset($disabled) && $disabled == true  && $disabled == true  ? 'disabled' : '' }}>
    <small class="warning-text"></small>
</div>
@push('scripts')
<script>
    jQuery(function () {
        $("#field_{{ $field->id }}").focusout(function () {
            $(this).removeClass('warning');
            var val = this.value;
            let msg = '';

            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (val.length != 0) {
                if (!regex.test(val)) {

                    $(this).addClass('warning');
                    msg = 'ველი უნდა შეიცავდეს ელ.ფოსტას';
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
