$(document).ready(function(){
 
    //display modal form for creating new klasifikasi *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmklasifikasi').trigger("reset");
        $('#myModal').modal('show');
    });


    //display modal form for product EDIT ***************************
    $(document).on('click','.edit-modal',function(){
       var id_klasifikasi = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: "http://perpus.ku/klasifikasi/"+id_klasifikasi+"/edit",
            success: function (data) {
                console.log(data);
                $('#id_klasifikasi').val(data.id);
                $('#kelas').val(data.kelas);
                $('#ket').val(data.ket);
                $('#btn-save').val("update");
                $('#myModal').modal('show');
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
        var id_klasifikasi = $('#id_klasifikasi').val();
        var ket = $('#ket').val();
        var my_url  = "http://perpus.ku/klasifikasi";
        var status = 'Data '+ ket +' Berhasil Ditambah !';

        if (state == "update"){
            type = "POST"; //for updating existing resource tapi new FormData($('#frmUser')[0]) tidak bisa pake PATCH/PUT
            my_url += '/' + id_klasifikasi;
            status = 'Data '+ ket +' Berhasil Diupdate !';
        }

        $.ajax({
            type  : type,
            url   : my_url,
            // untuk kirim file -> serelieze()-> gak bisa
            data  : new FormData($('#frmKlasifikasi')[0]),
            // data: $('#frmUser').serialize(),
            // Tell jQuery not to process data or worry about content-type
            // You *must* include these options!
            cache : false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                $('.errorKelas').addClass('hidden');
                $('.errorKet').addClass('hidden');      

                if ((data.errors)) {
                        setTimeout(function () {
                            $('#myModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.kelas) {
                            $('.errorKelas').removeClass('hidden');
                            $('.errorKelas').text(data.errors.kelas);
                        }
                        if (data.errors.ket) {
                            $('.errorKet').removeClass('hidden');
                            $('.errorKet').text(data.errors.ket);
                        }
                    } 
                    else {
                       
                        toastr.success(status,'Success Alert', {timeOut: 5000});
                    }

                console.log(data);
                $('#tKlasifikasi').DataTable().ajax.reload(); //autoreload yajra datatables
                $('#frmKlasifikasi').trigger("reset");
                $('#myModal').modal('hide');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });  

    //display modal form for delete klasifikasi *********************
    /*$('.hapus-modal').click(function(){
        //$('#btn-hapus').val("hapus");
        $('#ModalHapus').modal('show');
    });*/


    //delete klasifikasi and remove it from TABLE list ***************************
    //$(document)-> DOM siap dulu
    $(document).on('click','.hapus-modal',function(){
        var id_klasifikasi = $(this).val();
        $('#ModalHapus').modal('show');

    //delete klasifikasi and remove it from TABLE list ***************************
    $("#btn-hapus").click(function (e) {
        var url = "http://perpus.ku/klasifikasi";

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + id_klasifikasi+"/hapus",
            success: function (data) {
                console.log(data);
                $('#tKlasifikasi').DataTable().ajax.reload(); //autoreload yajra datatables
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


    // tampil detail klasifikasi render view ================================
    $(document).on('ajaxComplete ready', function () {
    $('.modalMd').off('click').on('click', function () {
        $('#modalMdContent').load($(this).attr('value'));
        // $('#modalMdTitle').html($(this).attr('title'));

    });

});


});