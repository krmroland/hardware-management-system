<form method="post" action="{{ $form->action }}" class="{{ $form->class }}">

    @if ($form->type=='post')
    {{ csrf_field() }}
    @endif


    @if ($form->method)
    {{ method_field($form->method) }}
    @endif
            {{--  @stack("fields") --}}
             @foreach ($form->fields as $field)
             {{--   activate the form model on all the fields while including them --}}
             <div class="{{ $field->wrapperClass }}">
                 @include(
                 $field->model($form->model)->render()->viewPath(),
                 $field->viewData()) 
             </div>
             @endforeach
    
</form>

