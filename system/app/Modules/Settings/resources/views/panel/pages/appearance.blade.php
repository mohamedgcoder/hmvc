@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'title')) }}</span>
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'appearance.title')) }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'appearance.header')) }}</h5>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card border-left-primary">
            <div class="card-body">
                <form id="formAppearance" action="#">
                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label">{{ Str::title(_trans($namespace, 'appearance.title_separation')) }}:</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="title_separation" value="{{_settings('settings', 'title_separation')}}">
                        </div>
                    </div>

                    @include(_current_theme('components.buttons.spinner'), [
                        "form" => "formAppearance",
                        "url" => Route('settings.update'),
                        "id" => "appearance",
                        "method" => 'PUT',
                        "float" => "text-right",
                        "value" => __('buttons.save_changes'),
                    ])
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                {{-- <h5 class="text-muted">{{ Str::title(_trans($namespace, 'integrations.header')) }}</h5> --}}
                <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'appearance.color')) }}</h5>
            </div>
        </div>
        <div class="card border-left-primary">
            <div class="card-body">
                <form id="formColor" action="#">
                    <span class="form-text text-muted">{!! _trans($namespace, 'appearance.color-note') !!}</span>
                    <div class="row mt-2">
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="pt-1">{{ Str::title(_trans($namespace, 'appearance.logo_color')) }}:</label>
                                <div class="float-right">
                                    <input type="text" class="form-control colorpicker" name="logo_color" data-preferred-format="hex" data-show-buttons="true" data-fouc="" value="{{_settings('settings', 'logo_color')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="pt-1">{{ Str::title(_trans($namespace, 'appearance.navbar_color')) }}:</label>
                                <div class="float-right">
                                    <input type="text" class="form-control navbar_color" name="navbar_color" data-preferred-format="hex" data-show-buttons="true" data-fouc="" value="{{_settings('settings', 'navbar_color')}}">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="pt-1">{{ Str::title(_trans($namespace, 'appearance.button_color')) }}:</label>
                                <div class="float-right">
                                    <input type="text" class="form-control main_color" name="main_color" data-preferred-format="hex" data-show-buttons="true" data-fouc="" value="{{_settings('settings', 'main_color')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="pt-1">{{ Str::title(_trans($namespace, 'appearance.border_color')) }}:</label>
                                <div class="float-right">
                                    <input type="text" class="form-control border_color" name="border_color" data-preferred-format="hex" data-show-buttons="true" data-fouc="" value="{{_settings('settings', 'border_color')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="pt-1">{{ Str::title(_trans($namespace, 'appearance.hover_color')) }}:</label>
                                <div class="float-right">
                                    <input type="text" class="form-control colorpicker hover_color" name="hover_color" data-preferred-format="hex" data-show-buttons="true" data-fouc="" value="{{_settings('settings', 'hover_color')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="pt-1">{{ Str::title(_trans($namespace, 'appearance.focus_color')) }}:</label>
                                <div class="float-right">
                                    <input type="text" class="form-control colorpicker focus_color" name="focus_color" data-preferred-format="hex" data-show-buttons="true" data-fouc="" value="{{_settings('settings', 'focus_color')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="pt-1">{{ Str::title(_trans($namespace, 'appearance.text_color')) }}:</label>
                                <div class="float-right">
                                    <input type="text" class="form-control text_color" name="text_color" data-preferred-format="hex" data-show-buttons="true" data-fouc="" value="{{_settings('settings', 'text_color')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="pt-1">{{ Str::title(_trans($namespace, 'appearance.text_hover_color')) }}:</label>
                                <div class="float-right">
                                    <input type="text" class="form-control colorpicker text_hover_color" name="text_hover_color" data-preferred-format="hex" data-show-buttons="true" data-fouc="" value="{{_settings('settings', 'text_hover_color')}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    @include(_current_theme('components.buttons.spinner'), [
                        "form" => "formColor",
                        "url" => Route('settings.update'),
                        "id" => "color",
                        "class" => "btn-".env('APP_NAME'),
                        "method" => 'PUT',
                        "float" => "text-right",
                        "value" => __('buttons.save_changes'),
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
    <script type="text/javascript" src="{{ _assets('js/plugins/pickers/color/spectrum.js') }}"></script>
    <script>
        $(".colorpicker").spectrum({
            showInitial: true, showInput: true, showAlpha: true, allowEmpty: true,
        });
        $(".navbar_color").spectrum({
            showInitial: true, showInput: true, showAlpha: true, allowEmpty: true,
            move: function(c) {
                var label = $('.navbar-dark');
                label.css('background-color', c);
            }
        });
        $(".main_color").spectrum({
            showInitial: true, showInput: true, showAlpha: true, allowEmpty: true,
            move: function(c) {
                var label = $('.submit');
                label.css('background-color', c);
            }
        });
        $(".border_color").spectrum({
            showInitial: true, showInput: true, showAlpha: true, allowEmpty: true,
            move: function(c) {
                var label = $('.submit');
                label.css('border-color', c);
            }
        });
        $(".text_color").spectrum({
            showInitial: true, showInput: true, showAlpha: true, allowEmpty: true,
            move: function(c) {
                var label = $('.submit');
                label.css('color', c);
            }
        });

        var _success = function() {
            new Noty({
                theme: ' alert bg-success text-white alert-styled-left alert-arrow-left p-0',
                header: 'success',
                text: "{!! __( 'messages.saved') !!}",
                type: 'alert',
                progressBar: true,
                closeWith: ['click']
            }).show();

            window.location.replace("{!! url()->current() !!}");
        };
    </script>
@endpush
