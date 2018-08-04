$(document).ready(function(){
  
    //display modal form for creating new penulis *********************
    $('#btn_addAnggota').click(function(){
        $('#btn-save').val("add");
        $('#frmAnggota').trigger("reset");
        $('#ModalAnggota').modal('show');
    });


    //display modal form for product EDIT ***************************
    $(document).on('click','.edit-modal',function(){
       var id_anggota = $(this).val();

       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: "http://perpus.ku/anggota/"+id_anggota+"/edit",
            success: function (data) {
                console.log(data);
                $('#id_anggota').val(data.id);
                $('#nis').val(data.nis);
                $('#nama_anggota').val(data.nama_anggota);
                $('#tgl_lahir').val(data.tgl_lahir);
             
                // radio button+++++++++++++++++++++++++
                $('[name="jenis_kelamin"]').removeAttr('checked');
                $('input[name=jenis_kelamin][value=' + data.jenis_kelamin + ']').prop('checked', true);

                $('#telepon').val(data.telepon);
                $('#alamat').val(data.alamat);
                $('#btn-save').val("update");
                $('#ModalAnggota').modal('show');
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
        var state           = $('#btn-save').val();
        var type            = "POST"; //for creating new resource
        var id_anggota      = $('#id_anggota').val();
        var nama_anggota    = $('#nama_anggota').val();
        var my_url          = "http://perpus.ku/anggota";
        var status          = 'Data '+ nama_anggota +' Berhasil Ditambah !';

        if (state == "update"){
            type = "POST"; //for updating existing resource tapi new FormData($('#frmUser')[0]) tidak bisa pake PATCH/PUT
            my_url += '/' + id_anggota;
            status = 'Data '+ nama_anggota +' Berhasil Diupdate !';
        }

        $.ajax({
            type  : type,
            url   : my_url,
            // untuk kirim file -> serelieze()-> gak bisa
            data  : new FormData($('#frmAnggota')[0]),
            // data: $('#frmUser').serialize(),
            // Tell jQuery not to process data or worry about content-type
            // You *must* include these options!
            cache : false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {

                $('.errorNis').addClass('hidden');
                $('.errorNamaAnggota').addClass('hidden');    
                $('.errorTglLahir').addClass('hidden'); 
                $('.errorTelepon').addClass('hidden');
                $('.errorAlamat').addClass('hidden'); 
                $('.errorFoto').addClass('hidden');     

                if ((data.errors)) {
                        setTimeout(function () {
                            $('#ModalAnggota').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nis) {
                            $('.errorNis').removeClass('hidden');
                            $('.errorNis').text(data.errors.nis);
                        }
                        if (data.errors.nama_anggota) {
                            $('.errorNamaAnggota').removeClass('hidden');
                            $('.errorNamaAnggota').text(data.errors.nama_anggota);
                        }
                        if (data.errors.tgl_lahir) {
                            $('.errorTglLahir').removeClass('hidden');
                            $('.errorTglLahir').text(data.errors.tgl_lahir);
                        }
                        if (data.errors.telepon) {
                            $('.errorTelepon').removeClass('hidden');
                            $('.errorTelepon').text(data.errors.telepon);
                        }
                        if (data.errors.alamat) {
                            $('.errorAlamat').removeClass('hidden');
                            $('.errorAlamat').text(data.errors.alamat);
                        }
                        if (data.errors.foto1) {
                            $('.errorFoto').removeClass('hidden');
                            $('.errorFoto').text(data.errors.foto1);
                        }
                    } 
                    else {
                       
                        toastr.success(status,'Success Alert', {timeOut: 5000});
                    }

                console.log(data);
                $('#tAnggota').DataTable().ajax.reload(); //autoreload yajra datatables
                // $('#frmUser').trigger("reset");
                $('#ModalAnggota').modal('hide');
               
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });  


    //delete penulis and remove it from TABLE list ***************************
    //$(document)-> DOM siap dulu
    $(document).on('click','.hapus-modal',function(){
        var id_anggota = $(this).val();
        $('#ModalHapus').modal('show');

    //delete penulis and remove it from TABLE list ***************************
    $("#btn-hapus").click(function (e) {
        var url = "http://perpus.ku/anggota";

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + id_anggota +"/hapus",
            success: function (data) {
                console.log(data);
                $('#tAnggota').DataTable().ajax.reload(); //autoreload yajra datatables
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