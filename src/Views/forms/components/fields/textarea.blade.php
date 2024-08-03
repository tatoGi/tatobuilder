<div class="form-group">
    <label for="field_{{ $field->id }}">{{ $field->title }}
        @if ($field->validation['required'] == 1)
            <span style="color: red">*</span>
        @endif
    </label>
    <textarea class="form-control"
    {{ $field->validation['required'] == 1 ? 'required' : '' }}
    id="field_{{ $field->id }}"
    name="answers[{{ $field->id }}]"
    placeholder="{{ $field->title }}"
    {{ isset($disabled) && $disabled == true ? 'disabled' : '' }}
    >{{ isset($accountAnswers->{$field->id}) ? $accountAnswers->{$field->id} : '' }}</textarea>
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
                @if ($field->validation['georgian'] == 1)
                    var regex = /^[ა-ჰ\s]+$/g;

                    if (!regex.test(val)) {
                        msg = 'ველი უნდა შეიცავდეს მხოლოდ ქართულ ასოებს';
                    }
                @endif

                @if ($field->validation['latin'] == 1)
                    var regex = /^[a-zA-Z\s]+$/g;

                    if (!regex.test(val)) {
                        msg = 'ველი უნდა შეიცავდეს მხოლოდ ლათინურ ასოებს';
                    }
                @endif

                @if ($field->validation['letters'] == 1)
                    var regex = /^[a-zA-Zა-ჰ\s]+$/g;

                    if (!regex.test(val)) {
                        msg = 'ველი უნდა შეიცავდეს მხოლოდ ასოებს';
                    }
                @endif
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
