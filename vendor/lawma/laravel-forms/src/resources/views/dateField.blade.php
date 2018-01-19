
<date 
    mode="{{$date->mode}}"
    maximum-date="{{ $date->maximum}}"
    label="{{ $date->label }}"
    default="{{$date->value}}" 
    name="{{ $date->name}}"
    error="{{$errors->first($date->name)}}"
>
</date>
