<div class="form-group my-2">
    <label for="">{{ $label }} {{ @$required == true ? '*' : '' }} </label>

    <input type={{ @$type ? $type : 'text' }} name={{ $name }} {{ @$required == true ? 'required' : '' }}
        class="form-control p-4 py-3" placeholder="{{ $placeholder }}" value="{!! @$value !!}">
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
