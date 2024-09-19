&copy; {{ Carbon\Carbon::now()->get('year') }}. <a href="https://{{ env('APP_DOMAIN') }}">{{ $appName }}</a>
@if(_is_tenant())
    by <a href="https://{{ env('APP_Domain') }}" target="_blank">{{ Str::upper(env('APP_NAME')) }}</a>
@elseif(!empty(env('OWNER_COMPANY_NAME')))
    by <a href="{{ env('OWNER_COMPANY_URL') }}" target="_blank">{{ Str::upper(env('OWNER_COMPANY_NAME')) }}</a>
@endif
