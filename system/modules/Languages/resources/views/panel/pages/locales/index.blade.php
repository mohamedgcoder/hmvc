@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'title')) }}</span>
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'locales')) }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col text-right">
        <button class="btn btn-primary " type="button" data-toggle="collapse" data-target="#addLocale" aria-expanded="false" aria-controls="addLocale">
            {{Str::title(__('buttons.add the', ['add' => _trans($namespace, 'locale')]))}}
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
                                <div class="form-group required">
                                    <label class="control-label">{{ Str::title(_trans($namespace, 'language')) }}:</label>
                                    @include(_current_theme('components.fields.select'), [
                                        "name" => "code",
                                        "placeholder" => Str::title(_trans($namespace, 'select language code')),
                                        "options" => _get_all_languages(),
                                        "selected" => null,
                                        "class" => null,
                                    ])
                                </div>

                                <div class="form-group required">
                                    <label class="control-label">{{ Str::title(_trans($namespace, 'flag')) }}:</label>
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
                                    <label class="control-label">{{ Str::title(_trans($namespace, 'direction')) }}:</label>
                                    @include(_current_theme('components.fields.select'), [
                                        "name" => "direction",
                                        "options" => [
                                            "rtl" => Str::title(_trans($namespace, 'rtl')),
                                            "ltr" => Str::title(_trans($namespace, 'ltr')),
                                        ],
                                        "selected" => "ltr",
                                    ])
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="control-label">{{ Str::title(__('index.status')) }}:</label>
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
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label class="control-label">{{ Str::title(__('index.default')) }}:</label>
                                            @include(_current_theme('components.fields.select'), [
                                                "name" => "default",
                                                "options" => [
                                                    "2" => Str::title(__('index.active')),
                                                    "3" => Str::title(__('index.inactive')),
                                                ],
                                                "selected" => "3",
                                                "class" => "",
                                            ])
                                        </div>
                                    </div>
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


<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table id="localesTable" class="table mb-2"></table>
            </div>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
    @include(_moduleName($namespace).'::panel.components.locales-datatables')
    @include(_current_theme('components.js.select'))
    <script>
        $('.flags').select2({
            templateResult: formatOption,
            templateSelection: formatOption
        });

        function formatOption(option) {
            var image = option.id;
            if(image != undefined){
                var optionWithImage = $('<span><img src="{{url("assets/global/flags")}}/'+image.trim()+'.png" class="img-flag"/> ' + option.text + '</span>');
                return optionWithImage;
            }
        }
    </script>
@endpush
