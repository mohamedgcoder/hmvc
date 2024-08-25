@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'title')) }}</span>
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'seo.title')) }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'seo.header')) }}</h5>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form id="formSeo" action="#">
                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                        @foreach(_get_languages() as $lang => $data)
                        <li class="nav-item">
                            <a class="nav-link @if(_current_Language() === $lang) active @endif" id="pills-{{$lang}}-tab" data-toggle="pill" href="#pills-{{$lang}}" role="tab" aria-controls="pills-{{$lang}}" aria-selected="true">
                                {!! _limit_of($data['trans'][_current_Language()], 25) !!}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="nav-tabContent">
                        @foreach(explode(',', _settings('language', 'available_locales')) as $lang)
                        <div class="tab-pane fade show @if(_current_Language() === $lang) active @endif" id="pills-{{$lang}}" role="tabpanel" aria-labelledby="pills-{{$lang}}-tab">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-2 col-form-label">{{ Str::title(_trans($namespace, 'seo.slogan')) }}:</label>
                                <div class="col-sm-12 col-md-9 col-lg-10">
                                    <input type="text" class="form-control" value="{{$settings['slogan'][$lang]}}" name="slogan[{{$lang}}]" placeholder="{{ Str::title(_trans($namespace, 'seo.slogan-placeholder')) }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-2 col-form-label">{{ Str::title(_trans($namespace, 'seo.description')) }}:</label>
                                <div class="col-sm-12 col-md-9 col-lg-10">
                                    <textarea rows="3" cols="3" class="form-control" name="description[{{$lang}}]" placeholder="{!! Str::title(_trans($namespace, 'seo.description-placeholder')) !!}">
                                        {!! htmlspecialchars($settings['description'][$lang]) !!}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-12 col-md-3 col-lg-2 col-form-label">{{ Str::title(_trans($namespace, 'seo.keywords')) }}:</label>
                                <div class="col-sm-12 col-md-9 col-lg-10">
                                    <div class="mb-3">
                                        <input type="text" value="{{$settings['keywords'][$lang]}}" name="keywords[{{$lang}}]" class="form-control tags-input" data-fouc>
                                        <span class="form-text text-muted">{{ _trans($namespace, 'seo.keywords-def') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @include(_current_theme('components.buttons.spinner'), [
                        "form" => "formSeo",
                        "url" => Route('settings.update'),
                        "id" => "seo",
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
    <script src="{{ _assets('js/plugins/forms/tags/tagsinput.min.js') }}"></script>
    <script>
        $('.tags-input').tagsinput();

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
