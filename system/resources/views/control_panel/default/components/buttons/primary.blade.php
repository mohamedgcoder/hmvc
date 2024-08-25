<div class="@if(isset($float) && $float != null){{$float}} @endif form-group">
    <button
        id="{{ $id }}"
        type="@if(isset($type)){{ $type }}@endif"
        class="btn @if(isset($style) && $style != '' && $style != null){{$style.'-primary'}}@endif @if(isset($class)){{$class}}@endif"
        @if(isset($disabled) && $disabled == true) disabled @endif
        @if(isset($modal) && $modal != null) data-bs-toggle="modal" data-bs-target="#{{$modal}}" @endif
    >
    @if(!empty($icon))
        <i class="{{ $icon }}"></i>
    @endif
    {{ $value }}
    </button>
</div>
