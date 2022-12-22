<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use App\Imports\UsersImport;
use App\Imports\FamiliesImport;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;
use App\Models\Family;
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
        return response([
            'users' => User::count(),
            'families' => Family::first()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view('welcome');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($code)
    {
        return response([
            'status' => false,
            'name' => 'Wahab Taofeek'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Excel::import(new FamiliesImport, $request->file('file'));
        return response([
            'message' => 'Imported'
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

    public function linkUsers()
    {
        $families = Family::all();
        foreach ($families as $key => $family) {
            $members = User::where('family_id', $family->id)->count();
            if ($members < $family->family_size) {
                for ($i = $members; $i < $family->family_size; $i++) {
                    $data = [
                        'family_member' => $i + 1,
                        'family_id' => $family->fid,
                        'package' => $family->package_type,
                        'name' => 'The ' . $family->firstname,
                        'code' => $this->getCode($family->package_type)
                    ];

                    //
                    User::create($data);
                }
            }
        }
    }

    private function getCode($package)
    {
        $total = User::where('package', $package)->count();
        $code = str_pad(strval($total + 1), 4, "0", STR_PAD_LEFT);
        switch (strtolower($package)) {
            case 'chrismas':
                $packageCode = 'EKH/XMS/';
                break;

            case 'new year':
                $packageCode = 'EKH/NEWYR/';
                break;

            case 'vacation':
                $packageCode = 'EKH/VAC/';
                break;

            case 'guest':
                $packageCode = 'EKH/GUEST/';
                break;

            case 'chaperone':
                $packageCode = 'CHAPERONE/';
                break;
        }

        return $packageCode . $code;
    }
}
