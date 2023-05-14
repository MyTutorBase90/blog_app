function delete_blog(slug)
{
    $("body").prepend($('#delete_blog'));
    $('#delete_blog').modal('show');

    $("#frm_destroy_blog").on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: "/blog/"+slug+"/delete",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_delete_spin_blog').show();
                $('.btn_delete_blog').prop('disabled', true);
            },
            success: function (response) {
                if (response.success) {
                    $('#frm_destroy_blog')[0].reset();
                    $('#blog_table').DataTable().ajax.reload();
                }
            },
            complete: function(){
                $('#delete_blog').modal('hide');
                $('.btn_delete_spin_blog').hide();
                $('.btn_delete_blog').prop('disabled', false);
            },
        });
    });
}

$(function(){
    $('#blog_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/blog/json_index',
        columns: [
            { data: 'DT_RowIndex', 'orderable': false, 'searchable': false, class: 'text-center' },
            {data: 'title'},
            {data: 'category'},
            {data: 'action', class: 'text-center'}
        ]
    });

    $('.select2').select2({
        allowClear: true
    });

    $('#summernote').summernote();

    $("#frm_crt_blog").on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/blog/store",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_crt_spin_blog').show();
                $('.btn_crt_blog').prop('disabled', true);
            },
            success: function (response) {
                if (response.errors) {
                    toastr.error(response.errors)
                    $('.btn_crt_spin_blog').hide();
                    $('.btn_crt_blog').prop('disabled', false);
                }

                if (response.error_extension) {
                    toastr.warning(response.error_extension)
                    $('.btn_crt_spin_blog').hide();
                    $('.btn_crt_blog').prop('disabled', false);
                }

                if (response.success) {
                    toastr.success(response.success)
                    $('#frm_crt_blog')[0].reset();
                    setTimeout(function() {
                        location.href = "/blog/"+response.slug+"/detail";
                    }, 500);
                }
            },
            complete: function(){
                $('#crt_category').modal('hide');
                $('.btn_crt_spin_blog').hide();
                $('.btn_crt_blog').prop('disabled', false);
            },
        });
    });

    $("#frm_edt_blog").on('submit', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "/blog/"+$(".slug").val()+"/update",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            beforeSend: function(){
                $('.btn_edt_spin_blog').show();
                $('.btn_edt_blog').prop('disabled', true);
            },
            success: function (response) {
                if (response.errors) {
                    toastr.error(response.errors)
                    $('.btn_edt_spin_blog').hide();
                    $('.btn_edt_blog').prop('disabled', false);
                }

                if (response.error_extension) {
                    toastr.warning(response.error_extension)
                    $('.btn_edt_spin_blog').hide();
                    $('.btn_edt_blog').prop('disabled', false);
                }

                if (response.success) {
                    toastr.success(response.success)
                    $('#frm_edt_blog')[0].reset();
                    setTimeout(function() {
                        location.href = "/blog/"+response.slug+"/detail";
                    }, 500);
                }
            },
            complete: function(){
                $('#edt_category').modal('hide');
                $('.btn_edt_spin_blog').hide();
                $('.btn_edt_blog').prop('disabled', false);
            },
        });
    });
})
