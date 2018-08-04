# Tentang program

# Yang di Uji
	1. Searching Buku Homepage
	2. Serching autocomplete peminjaman

# Fiture Program
	1. Template Admin LTE 														(OK)
	2. Menu : 
			1. Mater Data 	: buku,penerbit,penulis,tahun terbit,anggota 		(OK)
			2. Transaksi 	: buku masuk, peminjaman 							(OK)
			3. Telegram API : 													(OK)
			4. Laporan (PDF): anggota,buku,peminjaman,rekapLap, lapDetailPinjam	(OK)
			5. Dashboard	: chart 											(OK)
	3. Ajax 																	(OK)
	4. DB mysql + relasi + migration 											(OK)
	5. Tambahan fitur rating 													(-)
	6. Elasticsearch 															(masih proses)
		- (server harus satu tempat->docker semua/kernel linux semua)
		- sudo /etc/init.d/elasticsearch start 
		- sudo service elasticsearch stop   
		- curl -XGET 'localhost:9200/_cluster/health?pretty' 
	7. Cuma satu field pencarian seperti google(autocomplete) 
		simple but powerfull, msal cari: buku pengarang budi					(-)
		http://www.nerdthoughts.net/2015/03/good-posts-on-techniques-for.html
		https://scotch.io/tutorials/implementing-smart-search-with-laravel-and-typeahead-js

# Problem 
	1. linux -> gak perlu pake asset seperti di windows jika tampil single page
				tapi di template tetap pakai.
			 -> "theme/css/bootstrap.min.css" 
			 -> {{ asset('theme/css/bootstrap.min.css') }}
	2. Nginx configuration for Laravel 5.2 and PHP 7: Routes not working -> ganti di site-available->default
			-> location / {
						    try_files $uri $uri/ /index.php?$query_string;
						}
			-> location ~ \.php$ {
							    fastcgi_split_path_info ^(.+\.php)(/.+)$;
							    fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
							    fastcgi_index index.php;
							    include fastcgi_params;
							}
	3. sudo ln -s /usr/share/phpmyadmin/ /var/www/html/phpmyadmin 
	4. localhost is currently unable to handle this request. HTTP ERROR 500 with Laravel
		->setelah edit php.ini
		->memory_limit = -1
		->max_input_time = -1
		->sudo systemctl restart php7.0-fpm
	5. ajax yajra datatable
		->cek modal->js->route->controller->response(json)
		->id modal tidak boleh sama
	6. renderSections()
		-> menggabungkan view->ajax;
	7. Hapus file failed 
		-> permission folder
		-> cek php artisan tinker 
			->  File::delete('/var/www/perpus/public/fotouser/20180125041638.png');
	8. Rollback
		->  DB::beginTransaction();
            try 
            { 
                $penerbit->delete();
            }
            
            catch(\Illuminate\Database\QueryException $e) 
            {
                DB::rollback();
                return redirect()->back()->with('errorMessage', 'Integrity Constraint');
            }

            DB::commit();
    


		cek -> https://disq.us/url?url=https%3A%2F%2Fgithub.com%2FAgusWijiSuhariono%2FdemoApp%3AakQAYxuGaw0iyARQbtSI5uXnkTA&cuid=5251392


		https://github.com/LPology/Simple-Ajax-Uploader
		https://stackoverflow.com/questions/166221/how-can-i-upload-files-asynchronously/8758614#8758614

		9. Misal view tidak mau berubah ( hapus cache browser & laravel gagal)
			->composer dumpautoload
			-> restart pc

		10. Yang ad select2 -> tabindex="-1" (hapus di modal)
		11. gagal sampe response
			-> inactive dulu -> use Searchable;
			-> format table DB mysql harus ad timestamp (laravel eloquent)
		12. format fulltextsearch harus text !!!
		13. Jika gagal fungsi renderSection
			-> cek jquery = <!-- jQuery 2.2.3 -->

		14. return result ES > 10
			The right solution would be to use scrolling.
			However, if you want to extend the results search returns beyond 10,000 results, you can do it easily with Kibana:

			Go to Dev Tools and just post the following to your index (your_index_name), specifing what would be the new max result window

			PUT your_index_name/_settings
			{ 
			  "max_result_window" : 500000 
			}

			If all goes well, you should see the following success response:
			{
			  "acknowledged": true
			}
			
			https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-query-string-query.html
			https://www.elastic.co/blog/found-fuzzy-search

		15. Biar yajra datatable load with huge data

			->collection
			{
				$query  = Buku::all();
        		return $datatables->collection($query)
			}

			->ganti eloquent
			{
				$query = Buku::query();
        		return $datatables->eloquent($query)
			}

		16. jika gagal auto index eloquent elasticsearch/seting elasticsearch
			-> pesan  error ->  "reason": "blocked by: [FORBIDDEN/12/index read-only / allow delete (api)];"
			-> berarti memori HDD low -> free space
			-> run -> curl -XPUT -H "Content-Type: application/json" http://localhost:9200/_all/_settings -d '{"index.blocks.read_only_allow_delete": null}'

		17. How to create a printable Twitter-Bootstrap page
			-> Replace every col-md- with col-xs-

		18. Alert n hidden button OK jika stok = 0 

## Revisi Program
	1. Total laporan keuangan 	(clear)
	2. Rekap laporan per?		(clear)	
    3. Kartu anggota			(clear)
    4. Pengembalian buku		(clear)
    5. Batas pinjam buku 		(clear)


			

        	


https://www.elastic.co/blog/found-optimizing-elasticsearch-searches

http://docs.searchkit.co/stable/
https://github.com/abecms/recipe-elasticsearch

https://www.algolia.com/doc/api-client/laravel/relationships/#relationships
http://www.runningcoder.org/jquerytypeahead/demo/


	
## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
