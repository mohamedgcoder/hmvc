<script src="{{ _assets('js/plugins/datatables/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        var table = $('#adminTable').DataTable({
            select: true,
            rowId: 'code',
            order: [[ 1, 'desc' ]],
            lengthMenu: [10, 20, 50, 100, 200, 500],
            ajax: {
                url: "{{ Route(Str::lower($namespace).'.getall') }}",
            },
            columns: [
                {
                    data: "avatar",
                    // title: "{{_trans($namespace, 'avatar')}}",
                    orderable: false,
                    "render": function ( data) {
                    return '<img class="rounded" src="'+data+'" width="35px">';}
                },
                {
                    data: 'code',
                    title: "{{_trans($namespace, 'code')}}",
                },
                {
                    data: 'name',
                    title: "{{_trans($namespace, 'name')}}",
                },
                {
                    data: 'phone',
                    title: "{{_trans($namespace, 'phone')}}",
                },
                {
                    data: 'email',
                    title: "{{_trans($namespace, 'email')}}",
                }
            ]
        });
        $('input[type=search]').addClass('ml-2');
    });

</script>
