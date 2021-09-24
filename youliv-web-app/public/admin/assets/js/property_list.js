

$( document ).ready(function() {


    if ($('.property-list-data').length > 0) {
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "property_list_data",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'property_code', name: 'property_code'},
                    {data: 'owner_name', name: 'owner_name'},
                    {data: 'complete_address', name: 'complete_address'},
                    {data: 'area_manager', name: 'area_manager'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    }







});
