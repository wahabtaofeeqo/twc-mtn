<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;
use Mail;
use App\Mail\QrCodeMail;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $connector = new WindowsPrintConnector("Gprinter GP-3200TLA");
        $printer = new Printer($connector);
        $printer->text("Hello World!\n");
        $printer->cut();
        $printer->close();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Excel::import(new UsersImport, storage_path('users.xlsx'));
        return response([
            'message' => 'Done '. storage_path('users.xlsx')
        ]);
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmail()
    {
        $users = User::where('mail_sent', 0)->get();
        foreach ($users as $key => $user) {
            $this->doSend($user);
        }
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function sendStats()
    {
        $users = User::count();
        $sent = User::where('mail_sent', 1)->count();

        return response([
            'sent' => $sent,
            'users' => $users
        ]);
    }

    private function doSend($user) {
        try {
            $ticketName = "Party";
            $rand = rand(100, 9999);
            $user_id = mt_rand(13, rand(100, 99999990));

            $path = public_path('qrcode/' . $user->email);
            if(!file_exists($path)) mkdir($path, 0777, true);

            $file = strtolower($ticketName) . '_' . $rand . ".png";
            $filename = $path . "/" . $file;

            \QrCode::color(255, 0, 127)->format('png')
                ->size(500)->generate(strval($rand), $filename);
            Mail::to($user)->send(new QrCodeMail($user, $file));

            // Update model
            $user->code = $rand;
            $user->mail_sent = true;
            $user->save();
        }
        catch (\Throwable $th) {
            //throw $th;
        }
    }
}
