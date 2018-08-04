<?php 

namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use App\Buku;
use App\Anggota;
use App\Peminjaman;
use Charts;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except'=>['homepage']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function homepage()
    // {
    //     $buku_list = Buku::all();
    //     return view('frontend.index', compact('buku_list'));
    // }

    public function admin()
    {
        return view ('pages.admin'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function dashboard(){
        $data['halaman']        = 'dashboard';
        $data['jumlah_buku']    = Buku::count();
        $data['stok']           = Buku::sum('stok');
        $data['jumlah']         = Buku::sum('jumlah');
        $data['jumlah_anggota'] = Anggota::count();
        $data['jumlah_pinjam']  = Peminjaman::count();

        // // chart
        //  $data['chart'] = Charts::multi('area', 'morris')
        //     // Setup the chart settings
        //     ->title("My Cool Chart")
        //     // A dimension of 0 means it will take 100% of the space
        //     ->dimensions(0, 400) // Width x Height
        //     // This defines a preset of colors already done:)
        //     ->template("material")
        //     // You could always set them manually
        //     // ->colors(['#2196F3', '#F44336', '#FFC107'])
        //     // Setup the diferent datasets (this is a multi chart)
        //     ->dataset('Element 1', [5,20,100])
        //     ->dataset('Element 2', [15,30,80])
        //     ->dataset('Element 3', [25,10,40])
        //     // Setup what the values mean
        //     ->labels(['One', 'Two', 'Three']);

        $data['chart'] = Charts::multiDatabase('line', 'highcharts')
                            ->title("Grafik Buku, Anggota dan Peminjaman Buku")
                            ->dataset('Buku', Buku::all())
                            ->dataset('Anggota', Anggota::all())
                            ->dataset('Peminjaman', Peminjaman::all())
                            ->colors(['#2196F3', '#F44336', '#FFC107'])
                            ->groupByMonth();
        return view('pages.dashboard',$data);
    }
}
