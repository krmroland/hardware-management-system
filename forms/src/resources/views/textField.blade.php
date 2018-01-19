<div class="form-group">
 @include('forms::label')
   <input type="{{ $field->type }}" name="{{ $field->name }}" 
         class="form-control {{$errors->has("$field->name")?'is-invalid':''}}  {{ $field->class }}"  
         placeholder="{{ $field->getPlaceholder() }}" value="{{ $field->value }}">
   @include('forms::error')       
   
</div>
