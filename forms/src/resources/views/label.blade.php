@if ($field->label)
<label class="{{$errors->has("$field->name")?'text-danger':'text-dark'}} d-block {{ $field->labelClass }}">
    {{ ucfirst($field->label) }}
</label>
@endif
