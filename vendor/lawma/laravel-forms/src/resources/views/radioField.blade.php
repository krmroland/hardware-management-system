<div class="form-group">
  @include('forms::label')
   @foreach($field->choices as $key=>$choice)
   <label class="custom-control custom-radio {{ $field->class }}">
   @if ($field->hasKeys)
     <input  name="{{ $field->name }}" type="radio" class="custom-control-input 
     {{ $errors->has($field->name)?'is-invalid':'' }}" value="{{ $key }}" 
     {{ $field->checkedStatus($key)}}
     >
     @else
     <input  name="{{ $field->name }}" type="radio" class="custom-control-input 
     {{ $errors->has($field->name)?'is-invalid':'' }}" value="{{ $choice }}" 
     {{ $field->checkedStatus($choice)}}
     >

   @endif
      
      <span class="custom-control-indicator"></span>
      <span class="custom-control-description ">{{ ucfirst($choice) }}</span>

  </label>

  @endforeach
  @include('forms::error')

</div>
