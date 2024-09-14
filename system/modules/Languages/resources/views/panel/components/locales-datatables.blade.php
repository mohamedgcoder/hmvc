<script src="{{ _assets('js/plugins/datatables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var table = $('#localesTable').DataTable({
            select: true,
            stateSave: true,
            rowId: 'code',
            order: [[ 1, 'desc' ]],
            lengthMenu: [10, 20, 50, 100, 200, 500],
            // columnDefs: [ {
            //     orderable: false,
            //     className: 'select-checkbox',
            //     targets:   0
            // } ],
            // select: {
            //     style:    'os',
            //     selector: 'td:first-child'
            // },

            ajax: {
                url: "{{ Route(Str::lower($namespace).'.getall') }}",
            },
            columns: [
                // { data: "select" },
                {
                    data: "flag",
                    title: "{{_trans($namespace, 'flag')}}",
                    orderable: false,
                    "render": function ( data) {
                    return '<img class="rounded" src="'+data+'" width="35px">';}
                },
                {
                    data: 'code',
                    title: "{{_trans($namespace, 'code')}}"
                },
                {
                    data: 'dir',
                    title: "{{_trans($namespace, 'direction')}}"
                },
                {
                    data: 'status',
                    title: "{{__('index.status')}}"
                },
                {
                    data: 'action',
                    title: "{{__('index.action')}}"
                }
            ]
        });
        $('input[type=search]').addClass('ml-2');
    });

</script>
