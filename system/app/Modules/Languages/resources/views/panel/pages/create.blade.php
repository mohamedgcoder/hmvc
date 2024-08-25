@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'title')) }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'locales')) }}</h5>
    </div>
    <div class="col text-right">
        <button class="btn btn-primary " type="button" data-toggle="collapse" data-target="#addLocale" aria-expanded="false" aria-controls="addLocale">
            {{Str::title(_trans($namespace, 'add new locale'))}}
            <i class="fas fa-plus"></i>
        </button>
    </div>
</div>

<div class="row mt-2">
    <div id="addLocale" class="col-lg-12 collapse">
        <div class="card">
            <div class="card-body">
                <form id="formLanguage" action="{{Route('languages.save')}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'language')) }}:</label>
                                    @include(_current_theme('components.fields.select'), [
                                        "name" => "code",
                                        "placeholder" => Str::title(_trans($namespace, 'select language code')),
                                        "options" => _get_all_languages(),
                                        "selected" => null,
                                        "class" => null,
                                    ])
                                </div>

                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'flag')) }}:</label>
                                    @include(_current_theme('components.fields.select'), [
                                        "name" => "flag",
                                        "options" => _get_countries(),
                                        "selected" => null,
                                        "class" => "flags",
                                    ])
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{{ Str::title(_trans($namespace, 'direction')) }}:</label>
                                    @include(_current_theme('components.fields.select'), [
                                        "name" => "direction",
                                        "options" => [
                                            "rtl" => Str::title(_trans($namespace, 'rtl')),
                                            "ltr" => Str::title(_trans($namespace, 'ltr')),
                                        ],
                                        "selected" => "ltr",
                                    ])
                                </div>

                                <div class="form-group">
                                    <label>{{ Str::title(__('index.status')) }}:</label>
                                    @include(_current_theme('components.fields.select'), [
                                        "name" => "status",
                                        "options" => [
                                            "2" => Str::title(__('index.active')),
                                            "3" => Str::title(__('index.inactive')),
                                        ],
                                        "selected" => "3",
                                        "class" => "",
                                    ])
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    @include(_current_theme('components.buttons.primary'), [
                        "id" => "language",
                        "type" => "submit",
                        "style" => "btn",
                        "float" => "text-right",
                        "value" => Str::title(__('buttons.add')),
                    ])
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            {{-- <div class="card-body">{{ Str::title(_trans($namespace, 'locales'))}}</div> --}}
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
    @include(_current_theme('components.js.select'))
    <script>
        function formatOption(option) {
            var image = option.id;
            if(image != undefined){
                var optionWithImage = $('<span><img src="{{url("assets/global/flags")}}/'+image+'.png" class="img-flag" /> ' + option.text + '</span>');
            }
            return optionWithImage;
        }

        $('.flags').select2({
            templateResult: formatOption,
            templateSelection: formatOption
        });

    </script>
@endpush
