<div class="navbar navbar-expand-lg navbar-light border-bottom-0 border-top">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text">
            @include(_current_theme('layouts.footer.copyright'))
        </span>
    </div>
</div>

{{-- <div class="pl-2"><div class="col-md-12 text-left text-muted p-2">
    Version 1.0.0
</div> --}}

@include(_current_theme('layouts.footer.scripts'))
