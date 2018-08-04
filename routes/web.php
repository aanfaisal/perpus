<?php  
   
/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| 
*/

Route::get('/list-stock-chunk', function() { 
  $begin = memory_get_usage();
  $start = microtime(true);
  DB::table('anggota')->orderby('id')->chunk(100, function($anggotas) {
    foreach ($anggotas as $anggota) {
      
        echo $anggota->nama_anggota . ' : ' . $anggota->id . '<br>';
      
    }
  });
  echo 'Total time usage : ' . (microtime(true) - $start); 
  echo '<br>';
  echo 'Total memory usage : ' . (memory_get_usage() - $begin);
});



Route::group(['middleware'=>['web']], function(){

	 
	Route::get('/', 'BukuController@homepage');
	
	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('register',function(){
		return redirect('/');
	});

	Route::get('admin', 'PagesController@admin');

	Route::get('dashboard', 'PagesController@dashboard');

	// buku
	Route::get('buku', 'BukuController@index');
	Route::get('bukuData', 'BukuController@getBuku');
	Route::post('buku', 'BukuController@store');
	Route::get('buku/{buku}/edit', 'BukuController@edit');
	Route::post('buku/{buku}', 'BukuController@update');
	Route::get('buku/{buku}/detail', 'BukuController@show');
	Route::get('buku/{buku}/detailf', 'BukuController@showf');
	Route::delete('buku/{buku}/hapus', 'BukuController@destroy');

	Route::get('buku/cari','BukuController@cari');
	Route::get('buku/carisql','BukuController@cariSql');
	Route::get('buku/cari/auto','BukuController@cariAuto');
	// Route::get('find/','BukuController@cariAuto');
	// Route::resource('buku', 'BukuController');
	// Route::post('buku/cari','BukuController@cari');

	Route::get('buku/cari_pdf','BukuController@cari_pdf');
	Route::get('buku/dwn_pdf','BukuController@dwn_pdf');
	Route::get('buku/semua_pdf','BukuController@semua_pdf');

	// anggota
	Route::get('anggota', 'AnggotaController@index');
	Route::get('anggotaData', 'AnggotaController@getAnggota');
	Route::post('anggota', 'AnggotaController@store');
	Route::get('anggota/{anggota}/edit', 'AnggotaController@edit');
	Route::post('anggota/{anggota}', 'AnggotaController@update');
	Route::get('anggota/{anggota}/detail', 'AnggotaController@show');
	Route::delete('anggota/{anggota}/hapus', 'AnggotaController@destroy');

	Route::get('anggota/cari_pdf','AnggotaController@cari_pdf');
	Route::get('anggota/dwn_pdfAnggota','AnggotaController@dwn_pdf');
	Route::get('anggota/semua_pdfAnggota','AnggotaController@semua_pdf');

	Route::get('anggota/cetakOrPdf','AnggotaController@cetakOrPdf');

	Route::get('anggota/dwn_pdfKartuAnggota','AnggotaController@dwn_pdfKartu');
	Route::get('anggota/semua_pdfKartuAnggota','AnggotaController@semua_pdfKartu');

	// elasticsearch
	// Route::get('anggota/cari','AnggotaController@cari');
	// Route::get('anggota/carisql','AnggotaController@carisql');

	// klasifikasi
	Route::get('klasifikasi', 'KlasifikasiController@index');
	Route::get('klasifikasiData', 'KlasifikasiController@getKlasifikasi');
	Route::post('klasifikasi', 'KlasifikasiController@store');
	Route::get('klasifikasi/{klasifikasi}/edit', 'KlasifikasiController@edit');
	Route::patch('klasifikasi/{klasifikasi}', 'KlasifikasiController@update');
	Route::get('klasifikasi/{klasifikasi}/detail', 'KlasifikasiController@show');
	Route::delete('klasifikasi/{klasifikasi}/hapus', 'KlasifikasiController@destroy');
	Route::get('klasifikasi/semua_pdf','KlasifikasiController@semua_pdf');

	// penulis
	Route::get('penulis', 'PenulisController@index');
	Route::get('penulisData', 'PenulisController@getPenulis');
	Route::post('penulis', 'PenulisController@store');
	Route::get('penulis/{penulis}/edit', 'PenulisController@edit');
	Route::patch('penulis/{penulis}', 'PenulisController@update');
	Route::get('penulis/{penulis}/detail', 'PenulisController@show');
	Route::delete('penulis/{penulis}/hapus', 'PenulisController@destroy');
	Route::get('penulis/semua_pdfPenulis','PenulisController@semua_pdf');

	// penerbit
	Route::get('penerbit', 'PenerbitController@index');
	Route::get('penerbitData', 'PenerbitController@getPenerbit');
	Route::post('penerbit', 'PenerbitController@store');
	Route::get('penerbit/{penerbit}/edit', 'PenerbitController@edit');
	Route::patch('penerbit/{penerbit}', 'PenerbitController@update');
	Route::get('penerbit/{penerbit}/detail', 'PenerbitController@show');
	Route::delete('penerbit/{penerbit}/hapus', 'PenerbitController@destroy');
	Route::get('penerbit/semua_pdf','PenerbitController@semua_pdf');

	// tahun
	Route::get('tahun_terbit', 'Tahun_terbitController@index');
	Route::get('tahun_terbitData', 'Tahun_terbitController@getTahun_terbit');
	Route::post('tahun_terbit', 'Tahun_terbitController@store');
	Route::get('tahun_terbit/{tahun_terbit}/edit', 'Tahun_terbitController@edit');
	Route::patch('tahun_terbit/{tahun_terbit}', 'Tahun_terbitController@update');
	Route::get('tahun_terbit/{tahun_terbit}/detail', 'Tahun_terbitController@show');
	Route::delete('tahun_terbit/{tahun_terbit}/hapus', 'Tahun_terbitController@destroy');
	Route::get('tahun_terbit/semua_pdfTahunterbit','Tahun_terbitController@semua_pdf');

	// user
	Route::get('user', 'UserController@index');
	Route::get('userData', 'UserController@getUser');
	Route::post('user', 'UserController@store');
	Route::get('user/{user}/edit', 'UserController@edit');
	Route::post('user/{user}', 'UserController@update');
	Route::get('user/{user}/detail', 'UserController@show');
	Route::delete('user/{user}/hapus', 'UserController@destroy');
	Route::get('user/semua_pdf','UserController@semua_pdf');

	// peminjaman
	Route::get('peminjaman', 'PeminjamanController@index');
	Route::get('peminjaman/tambah', 'PeminjamanController@create');
	Route::post('peminjaman',  'PeminjamanController@store');
	Route::get('peminjaman/{peminjaman}/edit', 'PeminjamanController@edit');
	Route::patch('peminjaman/{peminjaman}', 'PeminjamanController@update');
	Route::get('peminjaman/{peminjaman}/detail', 'PeminjamanController@show');
	Route::get('peminjaman/{peminjaman}/hapus', 'PeminjamanController@destroy');

	Route::get('peminjaman/{peminjaman}/buku/{buku}/hapus', 'PeminjamanController@hps_buku');
	
	Route::get('peminjaman/search/item', 'PeminjamanController@auto_item');
	Route::post('peminjaman/additem','PeminjamanController@addItem');
	Route::get('peminjaman/deleteitem/{id}', 'PeminjamanController@hapus');

	Route::get('peminjaman/detail/{kode}', 'PeminjamanController@show');
	 
	Route::get('peminjaman/{peminjaman}/cetak_pinjam','PeminjamanController@cetak_pinjam');	
	Route::get('peminjaman/{peminjaman}/cetak_pinjam_pdf','PeminjamanController@cetak_pinjam_pdf');	
	// Route::post('peminjaman/cek_stok_buku','PeminjamanController@cek_stok_buku');
	// Route::post('peminjaman/cari','PeminjamanController@cari');

	Route::get('peminjaman/cari_pdf','PeminjamanController@cari_pdf');
	Route::get('peminjaman/dwn_pdfPeminjaman','PeminjamanController@dwn_pdf');
	Route::get('peminjaman/semua_pdfPeminjaman','PeminjamanController@semua_pdf');

	// keuangan
	Route::get('keuangan/cari_pdf','KeuanganController@cari_pdf');
	Route::get('semua_keuangan','KeuanganController@index');
	Route::get('keuangan_pilih','KeuanganController@dwn_pdf');

	// rekaplap
	Route::get('rekap_lap/cari_pdf','Rekap_lapController@cari_pdf');
	Route::get('semua_rekap_lap','Rekap_lapController@index');
	Route::get('rekap_lap_pilih','Rekap_lapController@dwn_pdf');
	Route::get('rekap_lap_cetak','Rekap_lapController@rekap_lap_cetak');

	// telegram API 
	Route::get('telegram', 'TelegramController@index');
	Route::post('telegram/kirim','TelegramController@postSendMessage');
	Route::get('telegram/get-updates','TelegramController@getUpdates');

	// easyrec
	Route::get('easyrecLihatBuku','EasyrecBarangController@index');
	Route::get('easyrecLihatBuku/140','EasyrecBarangController@view');

	

});









