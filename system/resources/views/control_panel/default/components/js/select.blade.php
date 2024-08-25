
@push('footer-scripts')
    <script src="{{ _assets('js/plugins/forms/selects/select2.min.js') }}"></script>
    <script>
        $('.select').select2();
        $(document).on('select2:open', () => {
            document.querySelector('.select2-container--open .select2-search__field').focus();
        });
    </script>
@endpush
