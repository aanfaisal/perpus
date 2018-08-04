$(document).ready(function(){    
    var info    = $('.info');
    var $_token = $('#token').val();   
    
    $(".add").click(function (e) { 
        e.preventDefault(); 
        var url      = 'additem'; //url di routes setelah url utama-> controller

        var formData = {
                          'id'                : $('#id').val(),                         
                          'judul'             : $('#judul').val(), //id field barang di create.php
                          'id_penulis'        : $('#id_penulis').val(),                         
                          'id_penerbit'       : $('#id_penerbit').val(),
                          'id_tahun'          : $('#id_tahun').val(),
                          'stok'              : $('#stok').val(),
                         
                        }
        $.ajax({

            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            headers: { 'X-XSRF-TOKEN' : $_token },
            success: function (data) {
                console.log(data);
                
                info.hide().find('ul').empty();
                
                if(data.success == false && data.is_rules == 0)
                {
                    
                    $.each(data.errors, function(index, error) {
                        info.find('ul').append('<li>'+errors+'</li>');
                    });

                    info.slideDown();
                    info.fadeTo(2000, 500).slideUp(500, function(){
                       info.hide().find('ul').empty();
                    });
                }
                else if(data.success == undefined)
                {
                    
                    $.each(data, function(index, error) { 
                        info.find('ul').append('<li>'+error+'</li>');
                    });

                    info.slideDown();
                    info.fadeTo(2000, 500).slideUp(500, function(){
                       info.hide().find('ul').empty();
                    });
                }
                else
                {
                    var i = 0;
                    var item = '<tr id="item' + data.data.id + '"><td style="text-align:left;width:2%;">' + data.data.judul + '</td><td style="text-align:left;width:2%;">' + data.data.id_penulis + '</td><td style="text-align:left;width:2%;">' + data.data.id_penerbit + '</td><td style="text-align:left;width:2%;">' + data.data.id_tahun + '</td>';
                        item += '<td style="text-align:center;width:2%;"><a href="deleteitem/' + i + '" class="btn btn-sm btn-danger delete"><i class="fa-fa-trash"></1> Delete </a>';
                        item += '</td></tr>';
                    
                    $('#item-list').append(item);

                    $('#id').val('');
                    $('#judul').val('');
                    $('#id_penulis').val('');
                    $('#id_penerbit').val('');
                    $('#id_tahun').val('');
                     // $('#stok').val('');
                 
                }
            },
            error: function (data) {} 
        });
    });

});

