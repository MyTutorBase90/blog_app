function edit_tag(slug)
{
    $.ajax({
        type: "GET",
        url: "/tag/"+slug+"/edit",
        beforeSend: function(){

        },
        success: function (response) {
            $("body").prepend($('#edt_tag'));
            $('#edt_tag').modal('show');

            $('#tag_title').val(response.title);
            $('#tag_slug').val(response.slug);
        }
    });
}

function delete_tag(slug)
{
    $("body").prepend($('#delete_tag'));
    $('#delete_tag').modal('show');

    $("#frm_destroy_tag").on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/tag/"+slug+"/delete",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_delete_spin_tag').show();
                $('.btn_delete_tag').prop('disabled', true);
            },
            success: function (response) {
                if (response.success) {
                    $('#frm_destroy_tag')[0].reset();
                    $('#tag_table').DataTable().ajax.reload();
                }
            },
            complete: function(){
                $('#delete_tag').modal('hide');
                $('.btn_delete_spin_tag').hide();
                $('.btn_delete_tag').prop('disabled', false);
            },
        });
    });
}
$(function(){
    $('#tag_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/tag/json_index',
        columns: [
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, class: 'text-center' },
            {data: 'title'},
            {data: 'action', class: 'text-center'}
        ]
    });

    $("#frm_crt_tag").on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/tag/store",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_crt_spin_tag').show();
                $('.btn_crt_tag').prop('disabled', true);
            },
            success: function (response) {
                if (response.success) {
                    $('#frm_crt_tag')[0].reset();
                    $('#tag_table').DataTable().ajax.reload();
                }
            },
            complete: function(){
                $('#crt_tag').modal('hide');
                $('.btn_crt_spin_tag').hide();
                $('.btn_crt_tag').prop('disabled', false);
            },
        });
    });

    $("#frm_edt_tag").on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/tag/"+$('#tag_slug').val()+"/update",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_edt_spin_tag').show();
                $('.btn_edt_tag').prop('disabled', true);
            },
            success: function (response) {
                if (response.success) {
                    $('#frm_edt_tag')[0].reset();
                    $('#tag_table').DataTable().ajax.reload();
                }
            },
            complete: function(){
                $('#edt_tag').modal('hide');
                $('.btn_edt_spin_tag').hide();
                $('.btn_edt_tag').prop('disabled', false);
            },
        });
    });
})
