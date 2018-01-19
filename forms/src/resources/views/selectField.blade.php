<div class="form-group">
  @include('forms::label')

  <select name="{{ $field->name }}" 
      class="form-control {{$errors->has("$field->name")?'is-invalid':''}}  {{ $field->class }}" >
      <option value="">{{ $field->getPlaceholder() }}</option>
      @foreach ($field->choices as $key=>$choice)
      @if ($field->hasKeys)
      <option value="{{ $key }}" {{ $field->selectedStatus($key) }}>{{ $choice }}
    </option>
      @else
      <option value="{{ $choice }}" {{ $field->selectedStatus($choice) }}>{{ $choice }}</option>
      @endif
      @endforeach
  </select>
  @include('forms::error')      
  
</div>
