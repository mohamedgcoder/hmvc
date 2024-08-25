@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'title')) }}</span>
    <span class="breadcrumb-item active">{{ Str::title(_trans($namespace, 'identity.title')) }}</span>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title text-muted">{{ Str::title(_trans($namespace, 'identity.header')) }}</h5>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form id="formIdentity" action="#">
                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                        @foreach(_get_languages() as $lang => $data)
                        <li class="nav-item">
                            <a class="nav-link @if(_current_Language() === $lang) active @endif" id="pills-{{$lang}}-tab" data-toggle="pill" href="#pills-{{$lang}}" role="tab" aria-controls="pills-{{$lang}}" aria-selected="true">{!! _limit_of($data['trans'][_current_Language()], 25) !!}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="nav-tabContent">
                        @foreach(explode(',', _settings('language', 'available_locales')) as $lang)
                        <div class="tab-pane fade show @if(_current_Language() === $lang) active @endif" id="pills-{{$lang}}" role="tabpanel" aria-labelledby="pills-{{$lang}}-tab">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">{{ Str::title(_trans($namespace, 'identity.name')) }}:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="name[{{$lang}}]" value="{{$settings[$lang]}}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @include(_current_theme('components.buttons.spinner'), [
                        "form" => "formIdentity",
                        "url" => Route('settings.update'),
                        "id" => "identity",
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
<script>
    var _success = function() {
        new Noty({
            theme: ' alert bg-success text-white alert-styled-left alert-arrow-left p-0',
            header: 'success',
            text: "{!! __( 'messages.saved') !!}",
            type: 'alert',
            progressBar: true,
            closeWith: ['click']
        }).show();
    };
</script>
@endpush
