<select
    id="{{$name}}"
    name="{{$name}}"
    @if(isset($placeholder) && $placeholder != null && !empty($placeholder)) data-placeholder="{{Str::title($placeholder)}}" @endif
    class="form-control select @if(isset($class) && $class != null && !empty($class)){!! $class !!} @endif"
    data-fouc>
    @if(isset($placeholder) && $placeholder != null && !empty($placeholder))<option></option>@endif

    @if(isset($optgroup) && $optgroup)
        @foreach ($options as $group => $opt)
        <optgroup label="{{ Str::title($group) }}">
            @foreach ($opt as $k => $option)
            <option
            value="@if(isset($value) && $value == false) {{$option}} @else {{$k}} @endif"
            @if(isset($selected) && $selected != null && !empty($selected) && $selected == ((isset($value) && $value == false) ? $option : $k))selected @endif>
                {{Str::title($option)}}
            </option>
            @endforeach
        </optgroup>
        @endforeach
    @else
        @foreach ($options as $k => $option)
        <option
        value="@if(isset($value) && $value == false && !empty($value)) {{$option}} @else {{$k}} @endif"
        @if(isset($selected) && $selected != null && !empty($selected) && $selected == ((isset($value) && $value == false) ? $option : $k))selected @endif>
            {{Str::title($option)}}
        </option>
        @endforeach
    @endif
</select>
