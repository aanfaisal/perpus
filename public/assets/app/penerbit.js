$(document).ready(function(){
 
    //display modal form for creating new penulis *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmPenerbit').trigger("reset");
        $('#ModPenerbit').modal('show');
    });


    //display modal form for product EDIT ***************************
    $(document).on('click','.edit-modal',function(){
       var id_penerbit = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: "http://perpus.ku/penerbit/"+id_penerbit+"/edit",
            success: function (data) {
                console.log(data);
                $('#id_penerbit').val(data.id);
                $('#nm_penerbit').val(data.nm_penerbit);
                $('#tlpn').val(data.tlpn);
                $('#alamat').val(data.alamat);
                $('#btn-save').val("update");
                $('#ModPenerbit').modal('show');
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
        })

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var id_penerbit = $('#id_penerbit').val();
        var nm_penerbit = $('#nm_penerbit').val();
        var my_url = "http://perpus.ku/penerbit";
        var status = 'Data '+ nm_penerbit +' Berhasil Ditambah !';     

        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_url += '/' + id_penerbit;
            status = 'Data '+ nm_penerbit +' Berhasil Diupdate !';
        }

        $.ajax({
            type: type,
            url: my_url,
            data: $('#frmPenerbit').serialize(),
            dataType: 'json',
            success: function (data) {
                $('.errorNama').addClass('hidden');
                $('.errorTlpn').addClass('hidden');    
                $('.errorAlamat').addClass('hidden'); 

                if ((data.errors)) {
                        setTimeout(function () {
                            $('#ModPenerbit').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nm_penerbit) {
                            $('.errorNama').removeClass('hidden');
                            $('.errorNama').text(data.errors.nm_penerbit);
                        }
                        if (data.errors.tlpn) {
                            $('.errorTlpn').removeClass('hidden');
                            $('.errorTlpn').text(data.errors.tlpn);
                        }
                        if (data.errors.alamat) {
                            $('.errorAlamat').removeClass('hidden');
                            $('.errorAlamat').text(data.errors.alamat);
                        }
                    } 
                    else {
                       
                        toastr.success(status,'Success Alert', {timeOut: 5000});
                    }


                console.log(data);
                $('#tPenerbit').DataTable().ajax.reload(); //autoreload yajra datatables
                // $('#frmPenulis').trigger("reset");
                $('#ModPenerbit').modal('hide')

            },

            error: function (data) {
                console.log('Error:', data);           
            }
        });
    });  


    //delete penerbit and remove it from TABLE list ***************************
    //$(document)-> DOM siap dulu
    $(document).on('click','.hapus-modal',function(){
        var id_penerbit = $(this).val();
        $('#ModalHapus').modal('show');

    //delete penerbit and remove it from TABLE list ***************************
    $("#btn-hapus").click(function (e) {
        var url = "http://perpus.ku/penerbit";

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + id_penerbit+"/hapus",
            success: function (data) {
                console.log(data);
                $('#tPenerbit').DataTable().ajax.reload(); //autoreload yajra datatables
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


    // tampil detail penulis render view ================================
    $(document).on('ajaxComplete ready', function () {
    $('.modalMd').off('click').on('click', function () {
        $('#modalMdContent').load($(this).attr('value'));
        // $('#modalMdTitle').html($(this).attr('title'));

    });

    });


});