$(document).ready(function(){

	//display modal form for product EDIT ***************************
    $(document).on('click','.cari',function(){
       // var id_buku = $(this).val();
       
        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: "http://perpus.ku/buku/cari",
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

});