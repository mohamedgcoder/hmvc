@if(count(config('app.languages')) == 1)
    <li class="nav-item">
        @foreach(config('app.languages') as $k => $language)
            @if($language['status'] == 2)
                <a href="#" class="navbar-nav-link navbar-nav-link-toggler" data-toggle="dropdown">
                    <img src="{{ url('assets/global/flags/'.$language['flag'].'.png') }}" class="img-flag" alt="">
                    <span class="d-none d-lg-inline-block ml-2">{{ (isset($language['trans'][_current_Language()]))? $language['trans'][_current_Language()] :  $language['trans'][_default_lang()] }}</span>
                </a>
            @endif
        @endforeach
    </li>
@elseif(count(config('app.languages')) > 1)
    <li class="nav-item nav-item-dropdown-lg dropdown">
        @foreach(config('app.languages') as $k => $language)
            @if($language['status'] == 2 && _current_Language() == $k )
                <a href="#" class="navbar-nav-link navbar-nav-link-toggler dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ url('assets/global/flags/'.$language['flag'].'.png') }}" class="img-flag" alt="">
                    <span class="d-none d-lg-inline-block ml-2">{{ Str::of((isset($language['trans'][$k]))? $language['trans'][$k] : $language['trans'][_default_lang()])->limit(25, preserveWords:true) }}</span>
                </a>
            @endif
        @endforeach

        <div class="dropdown-menu dropdown-menu-right">
            @foreach(config('app.languages') as $k => $language)
                @if($language['status'] == 2)
                    <a href="{{ url('language').'/'. $k }}" class="dropdown-item {{ (isset($language['trans'][_current_Language()]))? $language['trans'][_current_Language()] :  $language['trans'][_default_lang()] }} @if($k == _current_Language()) active @endif">
                        <img src="{{ url('assets/global/flags/'.$language['flag'].'.png') }}" class="img-flag" alt="">
                        {{ Str::of((isset($language['trans'][$k]))? $language['trans'][$k] : $language['trans'][_default_lang()])->limit(25, preserveWords:true) }}
                    </a>
                @endif
            @endforeach
        </div>
    </li>
@endif

