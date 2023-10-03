<div class="my-2 form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    @if (isset($label))
        <label for="{{ $label }}" class="control-label">{{ $label }} {{ @$required == true ? '*' : '' }}</label> 
    @endif

    <div class="col-md-12">
        <select name="{{ $name }}" id={{ @$id ? $id : '' }} class="form-control p-4 py-3">
            <option value="">{{ $label }}</option>
            @foreach ($resource as $item)
                <option value="{{ $item->$field_id }}" {{ $item->$field_id == @$value ? 'selected' : '' }}>
                    {{ $item->$field_name }}</option>
            @endforeach
        </select>

        @if ($errors->has($name))
            <span class="help-block">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</div>