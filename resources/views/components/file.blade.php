<div class="form-group my-2">
    <label for="">{{ $label }} {{ @$required == true ? '*' : '' }} </label>
    <input type={{ $type }} name={{ $name }} {{ @$required == true ? 'required' : '' }}
        class="form-control p-4 py-3" value={{ @$value }}>
</div>
