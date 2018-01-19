<div class="form-group">
 @include('forms::label')


 <textarea 
    class="form-control {{$errors->has("$field->name")?'is-invalid':''}}  {{ $field->class }}"

     name="{{ $field->name }}"
     placeholder="{{ $field->getPlaceholder() }}"
  >{{ trim($field->value) }}</textarea>
  
   @include('forms::error')       
   
</div>
