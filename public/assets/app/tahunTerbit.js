$(document).ready(function(){
 
    //display modal form for creating new penulis *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmTahunTerbit').trigger("reset");
        $('#ModTahun').modal('show');
    });

    //display modal form for product EDIT ***************************
    $(document).on('click','.edit-modal',function(){
       var id_tahunTerbit = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: "http://perpus.ku/tahun_terbit/"+id_tahunTerbit+"/edit",
            success: function (data) {
                console.log(data);
                $('#id_tahunTerbit').val(data.id);
                $('#tahun_terbit').val(data.tahun);
                $('#btn-save').val("update");
                $('#ModTahun').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });


    //create / update tahun terbit  ***************************
    $("#btn-save").click(function (e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var id_tahun = $('#id_tahunTerbit').val();
        var tahun = $('#tahun_terbit').val();
        var my_url = "http://perpus.ku/tahun_terbit";
        var status = 'Data '+ tahun +' Berhasil Ditambah !';       

        if (state == "update"){
            type = "PATCH"; //for updating existing resource
            my_url += '/' + id_tahun;
            status = 'Data '+ tahun +' Berhasil Diupdate !';
        }

        $.ajax({
            type: type,
            url: my_url,
            data: $('#frmTahunTerbit').serialize(),
            dataType: 'json',
            success: function (data) {
                $('.errorTahunTerbit').addClass('hidden');

                if ((data.errors)) {
                        setTimeout(function () {
                            $('#ModTahun').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.tahun) {
                            $('.errorTahunTerbit').removeClass('hidden');
                            $('.errorTahunTerbit').text(data.errors.tahun);
                        }
                    } 
                    else {
                       
                        toastr.success(status,'Success Alert', {timeOut: 5000});
                    }


                console.log(data);
                $('#tTahun').DataTable().ajax.reload(); //autoreload yajra datatables
                // $('#frmPenulis').trigger("reset");
                $('#ModTahun').modal('hide')

            },

            error: function (data) {
                console.log('Error:', data);           
            }
        });
    });  


    //delete penulis and remove it from TABLE list ***************************
    //$(document)-> DOM siap dulu
    $(document).on('click','.hapus-modal',function(){
        var id_tahun = $(this).val();
        $('#ModalHapus').modal('show');

    //delete penulis and remove it from TABLE list ***************************
    $("#btn-hapus").click(function (e) {
        var url = "http://perpus.ku/tahun_terbit";

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + id_tahun+"/hapus",
            success: function (data) {
                console.log(data);
                $('#tTahun').DataTable().ajax.reload(); //autoreload yajra datatables
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