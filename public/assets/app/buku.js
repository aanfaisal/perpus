$(document).ready(function(){
  
    //display modal form for creating new penulis *********************
    $('#btn_addBuku').click(function(){
        $('#btn-save').val("add");
        $('#frmBuku').trigger("reset");
        $('#ModBuku').modal('show');
    });


    //display modal form for product EDIT ***************************
    $(document).on('click','.edit-modal',function(){
       var id_buku = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: "http://perpus.ku/buku/"+id_buku+"/edit",
            success: function (data) {
                console.log(data);
                $('#id_buku').val(data.id);
                $('#judul').val(data.judul);

                // select2=======================================
                $('#id_penulis').val(data.id_penulis).trigger('change');
                $('#id_penerbit').val(data.id_penerbit).trigger('change');
                $('#id_tahun').val(data.id_tahun).trigger('change');
                $('#id_klasifikasi').val(data.id_klasifikasi).trigger('change');
                //================================================
                
                $('#jumlah').val(data.jumlah);
                $('#deskripsi').val(data.deskripsi);
                // $('#cover').val(data.cover);
                $('#btn-save').val("update");
                $('#ModBuku').modal('show');
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
        var id_buku         = $('#id_buku').val();
        var judul           = $('#judul').val();
        var my_url          = "http://perpus.ku/buku";
        var status          = 'Data '+ judul +' Berhasil Ditambah !';

        if (state == "update"){
            type = "POST"; //for updating existing resource tapi new FormData($('#frmUser')[0]) tidak bisa pake PATCH/PUT
            my_url += '/' + id_buku;
            status = 'Data '+ judul +' Berhasil Diupdate !';
        }

        $.ajax({
            type  : type,
            url   : my_url,
            // untuk kirim file -> serelieze()-> gak bisa
            data  : new FormData($('#frmBuku')[0]),
            // data: $('#frmUser').serialize(),
            // Tell jQuery not to process data or worry about content-type
            // You *must* include these options!
            cache : false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {

                $('.errorJudul').addClass('hidden');
                $('.errorNmPenulis').addClass('hidden');    
                $('.errorNmPenerbit').addClass('hidden'); 
                $('.errorTahun').addClass('hidden');
                $('.errorJumlah').addClass('hidden'); 
                $('.errorDeskripsi').addClass('hidden');
                $('.errorCover').addClass('hidden');      

                if ((data.errors)) {
                        setTimeout(function () {
                            $('#ModBuku').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.judul) {
                            $('.errorJudul').removeClass('hidden');
                            $('.errorJudul').text(data.errors.judul);
                        }
                        if (data.errors.id_penulis) {
                            $('.errorNmPenulis').removeClass('hidden');
                            $('.errorNmPenulis').text(data.errors.id_penulis);
                        }
                        if (data.errors.id_penerbit) {
                            $('.errorNmPenerbit').removeClass('hidden');
                            $('.errorNmPenerbit').text(data.errors.id_penerbit);
                        }
                        if (data.errors.id_tahun) {
                            $('.errorTahun').removeClass('hidden');
                            $('.errorTahun').text(data.errors.id_tahun);
                        }
                         if (data.errors.jumlah) {
                            $('.errorJumlah').removeClass('hidden');
                            $('.errorJumlah').text(data.errors.jumlah);
                        }
                        if (data.errors.deskripsi) {
                            $('.errorDeskripsi').removeClass('hidden');
                            $('.errorDeskripsi').text(data.errors.deskripsi);
                        }
                        if (data.errors.cover) {
                            $('.errorCover').removeClass('hidden');
                            $('.errorCover').text(data.errors.cover);
                        }
                    } 
                    else {
                       
                        toastr.success(status,'Success Alert', {timeOut: 5000});
                    }

                console.log(data);
                $('#tBuku').DataTable().ajax.reload(); //autoreload yajra datatables
                // $('#frmBuku').trigger("reset");
                $('#ModBuku').modal('hide');
               
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });  


    //delete penulis and remove it from TABLE list ***************************
    //$(document)-> DOM siap dulu
    $(document).on('click','.hapus-modal',function(){
        var id_buku = $(this).val();
        $('#ModalHapus').modal('show');

    //delete penulis and remove it from TABLE list ***************************
    $("#btn-hapus").click(function (e) {
        var url = "http://perpus.ku/buku";

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + id_buku +"/hapus",
            success: function (data) {
                console.log(data);
                $('#tBuku').DataTable().ajax.reload(); //autoreload yajra datatables
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