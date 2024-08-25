<div class="form-group @if(!empty($icon))form-group-feedback form-group-feedback-{{$iconPosition}} @endif">
    <input
        id="{{$id}}"
        type="@if(isset($type)){{$type}}@else text @endif"
        class="form-control"
        @if(isset($placeholder))placeholder="{{$placeholder}}" @endif
        name="{{$name}}"
        value="@if(isset($value)){{$value}}@endif"
        @if(isset($oninput))oninput="{{ $oninput }}" @endif
        @if(isset($disabled) && $disabled == true) disabled @endif
        @if(isset($required)  && $required == true) required @endif
    >
    @if(!empty($icon))
    <div class="form-control-feedback @if(isset($iconColor) && !empty($iconColor)){{$iconColor}} @endif ">
        <i class="{{$icon}}" @if(isset($iconClick) && !empty($iconClick))style="cursor: pointer;" onclick="{{$iconClick}}()" @endif></i>
    </div>
    @endif
    <label id="{{$id}}_message-error" class="validation-invalid-label" for="{{$id}}"></label>
</div>
