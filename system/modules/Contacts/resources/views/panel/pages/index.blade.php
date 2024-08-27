@extends(_current_theme('index'))

@push('styles')
    {{-- style here --}}
@endpush

@section('title', _title_separation().Str::title($title))

@section('breadcrumb')
    <span class="breadcrumb-item active">{!! Str::title(_trans($namespace, 'title')) !!}</span>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="card-title text-muted">{!! Str::title(_trans($namespace, 'header')) !!}</h5>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <div class="card border-left-info rounded-left-0">
            <div class="card-header">
                <legend class="font-weight-semibold text-muted">
                    <h5 class="card-title text-muted">{!! Str::title(_trans($namespace, 'phones.title')) !!}</h5>
                </legend>
            </div>
            <div class="card-body">
                <form id="formMail" action="#">
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{!! Str::title(_trans($namespace, 'phones.phone')) !!}:</label>
                                    <input type="text" class="form-control" name="phone" value="{!!_settings('contact', 'phone')!!}">
                                </div>
                                <div class="form-group">
                                    <label>{!! Str::title(_trans($namespace, 'phones.phone2')) !!}:</label>
                                    <input type="text" class="form-control" name="phone1" value="{!!_settings('contact', 'phone2')!!}">
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{!! Str::title(_trans($namespace, 'phones.fax')) !!}:</label>
                                    <input type="text" class="form-control" name="fax" value="{!!_settings('contact', 'fax')!!}">
                                </div>
                                <div class="form-group">
                                    <label>{!! Str::title(_trans($namespace, 'phones.whatsapp')) !!}:</label>
                                    <input type="text" class="form-control" name="whatsapp" value="{!!_settings('contact', 'whatsapp')!!}">
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="text-right">
                        <button form="formMail" url="{!! Route('settings.update') !!}" type="button" class="submit btn btn-primary btn-ladda btn-ladda-spinner" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20">
                            <span class="ladda-label">{!! __('buttons.save_changes') !!}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card border-left-primary rounded-left-0">
            <div class="card-header">
                <legend class="font-weight-semibold text-muted">
                    <h5 class="card-title text-muted">{!! Str::title(_trans($namespace, 'emails.title')) !!}</h5>
                </legend>
            </div>
            <div class="card-body">
                <form id="formMail" action="#">
                    <div class="row">
                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{!! Str::title(_trans($namespace, 'emails.from_name')) !!}:</label>
                                    <input type="text" class="form-control" name="from_name" value="{!!_settings('mail', 'from_name')!!}">
                                </div>
                                <div class="form-group">
                                    <label>{!! Str::title(_trans($namespace, 'emails.no-reply_email')) !!}:</label>
                                    <input type="text" class="form-control" name="no-reply_email" value="{!!_settings('mail', 'no-reply_email')!!}">
                                </div>
                            </fieldset>
                        </div>

                        <div class="col-lg-6">
                            <fieldset>
                                <div class="form-group">
                                    <label>{!! Str::title(_trans($namespace, 'emails.support_email')) !!}:</label>
                                    <input type="text" class="form-control" name="support_email" value="{!!_settings('mail', 'support_email')!!}">
                                </div>
                                <div class="form-group">
                                    <label>{!! Str::title(_trans($namespace, 'emails.technical_email')) !!}:</label>
                                    <input type="text" class="form-control" name="technical_email" value="{!!_settings('mail', 'technical_email')!!}">
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="text-right">
                        <button form="formMail" url="{!! Route('settings.update') !!}" type="button" class="submit btn btn-primary btn-ladda btn-ladda-spinner" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20">
                            <span class="ladda-label">{!! __('buttons.save_changes') !!}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card border-left-warning rounded-left-0">
            <div class="card-header">
                <legend class="font-weight-semibold text-muted">
                    <h5 class="card-title text-muted">{!! Str::title(_trans($namespace, 'addresses.title')) !!}</h5>
                </legend>
            </div>
            <div class="card-body">
                <form id="formMail" action="#">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label">{{ Str::title(_trans($namespace, 'addresses.location')) }}:</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="location" value="{{_settings('settings', 'location')}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-12">
                            <textarea name="editor-full" id="editor-full" rows="4" cols="4">
                                {!!_settings('settings', 'address')!!}
                            </textarea>
                        </div>
                    </div>

                    <div class="text-right">
                        <button form="formMail" url="{!! Route('settings.update') !!}" type="button" class="submit btn btn-primary btn-ladda btn-ladda-spinner" data-style="expand-left" data-spinner-color="#333" data-spinner-size="20">
                            <span class="ladda-label">{!! __('buttons.save_changes') !!}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection()

@push('footer-scripts')
<script src="{{ _assets('js/plugins/editors/ckeditor/ckeditor.js') }}"></script>
    <script>
        /* ------------------------------------------------------------------------------
 *
 *  # CKEditor editor
 *
 *  Demo JS code for editor_ckeditor.html page
 *
 * ---------------------------------------------------------------------------- */


// Setup module
// ------------------------------

var CKEditor = function() {


//
// Setup module components
//

// CKEditor
var _componentCKEditor = function() {
    if (typeof CKEDITOR == 'undefined') {
        console.warn('Warning - ckeditor.js is not loaded.');
        return;
    }




    // Full featured editor
    // ------------------------------

    // Setup
    CKEDITOR.replace('editor-full', {
        height: 400
    });


    // Readonly editor
    // ------------------------------

    // Setup
    var editorReadOnly = CKEDITOR.replace('editor-readonly', {
        height: 400
    });

    // The instanceReady event is fired when an instance of CKEditor has finished
    // its initialization.
    editorReadOnly.on('instanceReady', function (ev) {
        editorReadOnly = ev.editor;

        // Show this "on" button.
        document.getElementById('readOnlyOn').style.display = '';

        // Event fired when the readOnly property changes.
        editorReadOnly.on('readOnly', function () {
            document.getElementById('readOnlyOn').style.display = this.readOnly ? 'none' : '';
            document.getElementById('readOnlyOff').style.display = this.readOnly ? '' : 'none';
        });
    });

    // Toggle readonly state
    function toggleReadOnly(isReadOnly) {
        // Change the read-only state of the editor.
        // http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-setReadOnly
        editorReadOnly.setReadOnly(isReadOnly);
    }
    document.getElementById('readOnlyOn').onclick = function() {
        toggleReadOnly();
    }
    document.getElementById('readOnlyOff').onclick = function() {
        toggleReadOnly(false);
    }


    // Enter key configuration
    // ------------------------------

    // Define editor
    var editorKey;

    // Trigger initialization
    changeEnter();
};


//
// Return objects assigned to module
//

return {
    init: function() {
        _componentCKEditor();
    }
}
}();


// Initialize module
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
CKEditor.init();
});

    </script>
@endpush
