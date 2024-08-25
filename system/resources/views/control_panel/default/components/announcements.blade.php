@if(session()->has('announcement'))
<div class="row ml-3 mr-3">
    <div class="col alert {{ session('announcement')['type'] }}alert-styled-left alert-arrow-left alert-dismissible">
        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
        {{ Str::title(session('announcement')['message']) }}
    </div>
</div>
@endif

{{ session()->forget('announcement') }}