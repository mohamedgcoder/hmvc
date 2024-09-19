<style>
    :root {
        --{{env('APP_NAME')}}: {{ _settings('settings', 'main_color') }};
        --{{env('APP_NAME')}}-button: {{ _settings('settings', 'main_button') }};
        --{{env('APP_NAME')}}-border: {{ _settings('settings', 'border_color') }};
        --{{env('APP_NAME')}}-hover: {{ _settings('settings', 'hover_color') }};
        --{{env('APP_NAME')}}-focus: {{ _settings('settings', 'focus_color') }};
        --{{env('APP_NAME')}}-text: {{ _settings('settings', 'text_color') }};
        --{{env('APP_NAME')}}-text-hover: {{ _settings('settings', 'text_hover_color') }};
    }

    .btn-{{env('APP_NAME')}} {
        color: var(--{{env('APP_NAME')}}-text);
        background-color: var(--{{env('APP_NAME')}}-button);
        border-color: var(--{{env('APP_NAME')}}-border)
    }
    .btn-{{env('APP_NAME')}}:hover {
        color: var(--{{env('APP_NAME')}}-text-hover);
        background-color: var(--{{env('APP_NAME')}}-hover);
        border-color: var(--{{env('APP_NAME')}}-button)
    }
    .btn-check:focus+.btn-{{env('APP_NAME')}},
    .btn-{{env('APP_NAME')}}:focus {
        color: var(--{{env('APP_NAME')}}-text-hover);
        background-color: var(--{{env('APP_NAME')}}-focus);
        border-color: var(--{{env('APP_NAME')}}-button);
        box-shadow:0 0 0 .25rem rgba(red(var(--{{env('APP_NAME')}}-text-hover)), green(var(--{{env('APP_NAME')}}-text-hover)), blue(var(--{{env('APP_NAME')}}-text-hover)), .5);
    }
    .btn-check:active+.btn-{{env('APP_NAME')}},
    .btn-check:checked+.btn-{{env('APP_NAME')}},
    .btn-{{env('APP_NAME')}}.active,
    .btn-{{env('APP_NAME')}}:active,
    .show>.btn-{{env('APP_NAME')}}.dropdown-toggle {
        color: var(--{{env('APP_NAME')}}-text-hover);
        background-color:var(--{{env('APP_NAME')}}-button);
        border-color:var(--{{env('APP_NAME')}}-button)
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
        color: var(--{{env('APP_NAME')}}-text);
        background-color:var(--{{env('APP_NAME')}}-button);
        border-color:var(--{{env('APP_NAME')}}-button)
    }

    .text-{{env('APP_NAME')}}{
        color: var(--{{env('APP_NAME')}});
    }
    .border-{{env('APP_NAME')}}{
        border-color: var(--{{env('APP_NAME')}}) !important;
    }
</style>
