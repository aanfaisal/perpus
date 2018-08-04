$(document).ready(function(){
 
    //display modal form for creating new penulis *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmPenulis').trigger("reset");
        $('#myModal').modal('show');
    });


    //display modal form for product EDIT ***************************
    $(document).on('click','.edit-modal',function(){
       var id_penulis = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: "http://perpus.ku/penulis/"+id_penulis+"/edit",
            success: function (data) {
                console.log(data);
                $('#id_penulis').val(data.id);
                $('#nm_penulis').val(data.nm_penulis);
                $('#tlpn').val(data.tlpn);
                $('#alamat').val(data.alamat);
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
        })

        // e.preventDefault(); 
        // var formData = {
        //     nm_penulis: $('#nm_penulis').val(),
        //     tlpn: $('#tlpn').val(),
        //     alamat: $('#alamat').val(),
        // }

        //serialize() -> method ambil data dari form

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var id_penulis = $('#id_penulis').val();
        var nm_penulis = $('#nm_penulis').val();
        var my_url = "http://perpus.ku/penulis";
        var status = 'Data '+ nm_penulis +' Berhasil Ditambah !';
        // var nm_penulis: $('#nm_penulis').val(), tlpn: $('#tlpn').val(), alamat: $('#alamat').val();         

        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_url += '/' + id_penulis;
            status = 'Data '+ nm_penulis +' Berhasil Diupdate !';
        }

        $.ajax({
            type: type,
            url: my_url,
            data: $('#frmPenulis').serialize(),
            dataType: 'json',
            success: function (data) {
                $('.errorNama').addClass('hidden');
                $('.errorTlpn').addClass('hidden');    
                $('.errorAlamat').addClass('hidden'); 

                if ((data.errors)) {
                        setTimeout(function () {
                            $('#myModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nm_penulis) {
                            $('.errorNama').removeClass('hidden');
                            $('.errorNama').text(data.errors.nm_penulis);
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
                $('#tPenulis').DataTable().ajax.reload(); //autoreload yajra datatables
                // $('#frmPenulis').trigger("reset");
                $('#myModal').modal('hide')

            },

            error: function (data) {
                console.log('Error:', data);           
            }
        });
    });  


    //display modal form for delete penulis *********************
    /*$('.hapus-modal').click(function(){
        //$('#btn-hapus').val("hapus");
        $('#ModalHapus').modal('show');
    });*/


    //delete penulis and remove it from TABLE list ***************************
    //$(document)-> DOM siap dulu
    $(document).on('click','.hapus-modal',function(){
        var id_penulis = $(this).val();
        $('#ModalHapus').modal('show');

    //delete penulis and remove it from TABLE list ***************************
    $("#btn-hapus").click(function (e) {
        var url = "http://perpus.ku/penulis";

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + id_penulis+"/hapus",
            success: function (data) {
                console.log(data);
                $('#tPenulis').DataTable().ajax.reload(); //autoreload yajra datatables
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