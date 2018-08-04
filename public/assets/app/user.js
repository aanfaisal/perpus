$(document).ready(function(){
  
    //display modal form for creating new penulis *********************
    $('#btn_addUser').click(function(){
        $('#btn-save').val("add");
        $('#frmUser').trigger("reset");
        $('#ModalUser').modal('show');
    });


    //display modal form for product EDIT ***************************
    $(document).on('click','.edit-modal',function(){
       var id_user = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: "http://perpus.ku/user/"+id_user+"/edit",
            success: function (data) {
                console.log(data);
                $('#id_user').val(data.id);
                $('#nm_user').val(data.name);
                $('#email').val(data.email);
                $('#password').val(data.password);
                $('#btn-save').val("update");
                $('#ModalUser').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });


    //create / update penulis  ***************************
    $("#btn-save").click(function (e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state   = $('#btn-save').val();
        var type    = "POST"; //for creating new resource
        var id_user = $('#id_user').val();
        var nm_user = $('#nm_user').val();
        var my_url  = "http://perpus.ku/user";
        var status = 'Data '+ nm_user +' Berhasil Ditambah !';

        if (state == "update"){
            type = "POST"; //for updating existing resource tapi new FormData($('#frmUser')[0]) tidak bisa pake PATCH/PUT
            my_url += '/' + id_user;
            status = 'Data '+ nm_user +' Berhasil Diupdate !';
        }

        $.ajax({
            type  : type,
            url   : my_url,
            // untuk kirim file -> serelieze()-> gak bisa
            data  : new FormData($('#frmUser')[0]),
            // data: $('#frmUser').serialize(),
            // Tell jQuery not to process data or worry about content-type
            // You *must* include these options!
            cache : false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                $('.errorNama').addClass('hidden');
                $('.errorEmail').addClass('hidden');    
                $('.errorPassword').addClass('hidden'); 
                $('.errorFoto').addClass('hidden'); 

                if ((data.errors)) {
                        setTimeout(function () {
                            $('#ModalUser').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.name) {
                            $('.errorNama').removeClass('hidden');
                            $('.errorNama').text(data.errors.name);
                        }
                        if (data.errors.email) {
                            $('.errorEmail').removeClass('hidden');
                            $('.errorEmail').text(data.errors.email);
                        }
                        if (data.errors.password) {
                            $('.errorPassword').removeClass('hidden');
                            $('.errorPassword').text(data.errors.password);
                        }
                        if (data.errors.foto) {
                            $('.errorFoto').removeClass('hidden');
                            $('.errorFoto').text(data.errors.foto);
                        }
                    } 
                    else {
                       
                        toastr.success(status,'Success Alert', {timeOut: 5000});
                    }

                console.log(data);
                $('#table_user').DataTable().ajax.reload(); //autoreload yajra datatables
                // $('#frmUser').trigger("reset");
                $('#ModalUser').modal('hide');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });  


    //delete penulis and remove it from TABLE list ***************************
    //$(document)-> DOM siap dulu
    $(document).on('click','.hapus-modal',function(){
        var id_user = $(this).val();
        $('#ModalHapus').modal('show');

    //delete penulis and remove it from TABLE list ***************************
    $("#btn-hapus").click(function (e) {
        var url = "http://perpus.ku/user";

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + id_user+"/hapus",
            success: function (data) {
                console.log(data);
                $('#table_user').DataTable().ajax.reload(); //autoreload yajra datatables
                $('#ModalHapus').modal('hide');
                toastr.error('Data Berhasil Dihapus !', 'Success Alert', {timeOut: 5000});
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    //batal ***************************
    $("#btn-batal").click(function (e) {
        $('#ModalHapus').modal('hide');
      
    });

    });


    // tampil detail user render view ================================
    $(document).on('ajaxComplete detail', function () {

        $('.modalMd').off('click').on('click', function () {
            $('#modalMdContent').load($(this).attr('value'));
        });

    });

});