<style>
    :root {
        --{{env('APP_NAME')}}-color: {{ _settings('settings', 'main_color') }};
        --{{env('APP_NAME')}}-border-color: {{ _settings('settings', 'border_color') }};
        --{{env('APP_NAME')}}-hover-color: {{ _settings('settings', 'hover_color') }};
        --{{env('APP_NAME')}}-focus-color: {{ _settings('settings', 'focus_color') }};
        --{{env('APP_NAME')}}-text-color: {{ _settings('settings', 'text_color') }};
        --{{env('APP_NAME')}}-text-hover-color: {{ _settings('settings', 'text_hover_color') }};
    }

    .btn-{{env('APP_NAME')}} {
        color: var(--{{env('APP_NAME')}}-text-color);
        background-color: var(--{{env('APP_NAME')}}-color);
        border-color: var(--{{env('APP_NAME')}}-border-color)
    }
    .btn-{{env('APP_NAME')}}:hover {
        color: var(--{{env('APP_NAME')}}-text-hover-color);
        background-color: var(--{{env('APP_NAME')}}-hover-color);
        border-color: var(--{{env('APP_NAME')}}-color)
    }
    .btn-check:focus+.btn-{{env('APP_NAME')}},
    .btn-{{env('APP_NAME')}}:focus {
        color: var(--{{env('APP_NAME')}}-text-hover-color);
        background-color: var(--{{env('APP_NAME')}}-focus-color);
        border-color: var(--{{env('APP_NAME')}}-color);
        box-shadow:0 0 0 .25rem rgba(red(var(--{{env('APP_NAME')}}-text-hover-color)), green(var(--{{env('APP_NAME')}}-text-hover-color)), blue(var(--{{env('APP_NAME')}}-text-hover-color)), .5);
    }
    .btn-check:active+.btn-{{env('APP_NAME')}},
    .btn-check:checked+.btn-{{env('APP_NAME')}},
    .btn-{{env('APP_NAME')}}.active,
    .btn-{{env('APP_NAME')}}:active,
    .show>.btn-{{env('APP_NAME')}}.dropdown-toggle {
        color: var(--{{env('APP_NAME')}}-text-hover-color);
        background-color:var(--{{env('APP_NAME')}}-color);
        border-color:var(--{{env('APP_NAME')}}-color)
    }
    .btn-check:active+.btn-{{env('APP_NAME')}}:focus,
    .btn-check:checked+.btn-{{env('APP_NAME')}}:focus,
    .btn-{{env('APP_NAME')}}.active:focus,
    .btn-{{env('APP_NAME')}}:active:focus,
    .show>.btn-{{env('APP_NAME')}}.dropdown-toggle:focus {
        box-shadow:0 0 0 .25rem rgba(49,132,253,.5)
    }
    .btn-{{env('APP_NAME')}}.disabled,
    .btn-{{env('APP_NAME')}}:disabled {
        color: var(--{{env('APP_NAME')}}-text-color);
        background-color:var(--{{env('APP_NAME')}}-color);
        border-color:var(--{{env('APP_NAME')}}-color)
    }
</style>
