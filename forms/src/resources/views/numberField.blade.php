<div class="form-group">
    @include('forms::label')
    <input type="number" name="{{ $field->name }}" class="form-control {{$errors->has("$field->name")?'is-invalid':''}}"  
    placeholder="{{ $field->label }}" value="{{$field->value}}" step="{{ $field->step }}" >
    @include('forms::error')    
</div>
   

