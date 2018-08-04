<?php
 
namespace App\Http\Controllers; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $halaman = 'telegram';
        return view('telegram.index', compact('halaman'));
    }

    public function getUpdates()
    {
        $updates = Telegram::getUpdates();
        dd($updates);
    }

    public function postSendMessage(Request $request)
    {
        $rules = [
            'message' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails())
        {
            return redirect()->back()
                ->with('status', 'danger')
                ->with('message', 'Pesan Harus Di Isi');
        }

        Telegram::sendMessage([
            'chat_id' => -208746564,
            'text'    => $request->get('message')
        ]);

        return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Pesan Terkirim');
    }
}