<div class="@if(isset($float) && $float != null){{$float}} @endif form-group">
    <button id="{{ $id }}"
        type="@if(isset($type)){{ $type }}@endif"
        class="btn @if(isset($style) && $style != '' && $style != null){{$style.'-success'}}@endif btn-block @if(isset($class)){{$class}}@endif"
        @if(isset($disabled) && $disabled == true) disabled @endif
    >
    @if(isset($icon))
        <i class="{{ $icon }}"></i>
    @endif
    {{ $value }}
    </button>
</div>
