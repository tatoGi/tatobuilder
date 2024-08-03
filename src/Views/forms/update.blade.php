@extends('admin.layouts.app')
@push('name')
@endpush
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <button onclick="history.back()" class="btn btn-primary hBack"> back</button>
            <h4 class="card-title mb-4">Edit Forms</h4>
            <form class="forms-sample validate-form"
                action="/{{ app()->getLocale() }}/admin/forms/update/{{ $form->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label data-icon="-">title</label>
                    <input type="text" class="form-control" name="title" value="{{ $form->title ?? '' }}">
                    @error('name') <small class="error danger">{{ $errors->first('title') }}</small> @enderror
                </div>
                <div class="form-group">
                    <label data-icon="-">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name"
                        value="{{ $form->name ?? '' }}">
                    @error('name') <small class="error danger">{{ $errors->first('name') }}</small> @enderror
                </div>
                <div class="form-group">
                    <label data-icon="-">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email"
                        value="{{ $form->email ?? '' }}">
                    @error('name') <small class="error danger">{{ $errors->first('email') }}</small> @enderror
                </div>
                <div class="dd">

                    @include('admin.forms.includes.forms', [
                    'label' => trans('admin.add'),
                    'fields' => $form->fields

                    ])

                </div>

                <button type="submit" class="btn btn-primary me-2 btn-save-nestable"><i
                        class="mdi mdi-content-save"></i> Save</button>
            </form>
        </div>
    </div>
</div>



@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"
    integrity="sha512-7bS2beHr26eBtIOb/82sgllyFc1qMsDcOOkGK3NLrZ34yTbZX8uJi5sE0NNDYFNflwx1TtnDKkEq+k2DCGfb5w=="
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.css"
    integrity="sha512-WLnZn2zeYB0crLeiqeyqmdh7tqN5UfBiJv9cYWL9nkUoAUMG5flJnjWGeeKIs8eqy8nMGGbMvDdpwKajJAWZ3Q=="
    crossorigin="anonymous" />
<style>
    .dd {
        max-width: none;
    }

    [data-icon]:before {
        float: right;
        color: red;
        font-size: 24px;
    }

    .errtext {
        color: red;
    }

</style>

<script type="text/javascript">
    $(window).ready(function () {


        $('.dd').nestable({

            maxDepth: 1
        });
        $('.btn-save-nestable').click(function () {
            var $this = $(this);
            $.post("/{{ app()->getLocale() }}/admin/forms/arrange", {
                orderArr: $('.dd').nestable('serialize'),
                '_token': "{{ csrf_token() }}"
            }, function (data) {
                // $this.button('reset');
            });

        });
        $('.glyphicon').mousedown(function (e) {
            e.stopPropagation();
        });
    });

</script>
<script>
    $('.validate-form').submit(function (e) {
        if ($(this).find('.warning').length !== 0) {
            e.preventDefault();
            var $container = $("html,body");
            var $scrollTo = $('.warning');

            $container.animate({
                scrollTop: $scrollTo.offset().top - $container.offset().top + $container.scrollTop(),
                scrollLeft: 0
            }, 300);
        }
    });

</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $("#accordion").sortable();
    $('#add').formFields();
    $("#accordion").disableSelection();

</script>
@endpush


@endsection
