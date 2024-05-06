<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\User;
use App\Models\ClockedIn;
use Mail;
use Auth;
use App\Mail\QrcodeMail;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function metaView()
    {
        return view('meta');
    }

    public function login()
    {
        if(Auth::user())
            return redirect('profile');

        return view('login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'code' => ['required'],
        ]);

        $user = User::where('email', $credentials['code'])->first();
        if ($user) {
            Auth::login($user);
            $request->session()->regenerate();

            if($user->firstname == 'Admin')
                return redirect()->intended('dashboard');

            //
            return redirect()->intended('profile');
        }

        return back()->withErrors([
            'code' => 'The provided credentials do not match our records.',
        ])->onlyInput('code');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function verify($code)
    {
        // $code = str_replace('@', '%40', $code);
        //
        $user = User::where('code', $code)->first();

        if($user) {
            $model = ClockedIn::where('user_id', $user->id)
                ->whereDate('created_at', date('Y-m-d'))->first();

            if(!$model) {
                ClockedIn::create([
                    'user_id' => $user->id
                ]);
            }

            //
            return response([
                'data' => $user,
                'status' => true,
                'message' => 'Operation succeedded'
            ]);
        }
        else {
            return response([
                'status' => false,
                'message' => 'Account Information not found'
            ]);
        } 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Excel::import(new UsersImport, $request->file('file'));
        return response([
            'message' => 'Imported'
        ]); 
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function sendEmail()
    {
        // $users = User::where('sent', 0)->get();
        // foreach ($users as $key => $user) {
        //     $this->doSend($user);
        // }

        // $user = User::firstOrCreate(['email' => 'olasunkanmi@ideashouseng.com'], [
        //     'firstname' => 'Tester',
        //     'lastname' => 'Tester',
        //     'code' => 'name=Afamefuna+Ogujiofor&email=Afamefuna.Ogujiofor@mtn.com&org=Delegate&jobTitle=East'
        // ]);

        $copy1 = User::firstOrCreate(['email' => 'taofeekolamilekan218@gmail.com'], [
            'firstname' => 'Tao',
            'lastname' => 'Domain',
            'code' => 'name=Afamefuna+Ogujiofor&email=Afamefuna.Ogujiofor@mtn.com&org=Delegate&jobTitle=East'
        ]);

        // $copy2 = User::firstOrCreate(['email' => 'deloper447@gmail.com'], [
        //     'firstname' => 'Tester',
        //     'lastname' => 'Tester',
        //     'code' => 'name=Afamefuna+Ogujiofor&email=Afamefuna.Ogujiofor@mtn.com&org=Delegate&jobTitle=East'
        // ]);

        // $copy1 = User::firstOrCreate(['email' => 'ayo4real2009@gmail.com'], [
        //     'firstname' => 'Tester',
        //     'lastname' => 'Tester',
        //     'code' => 'name=Afamefuna+Ogujiofor&email=Afamefuna.Ogujiofor@mtn.com&org=Delegate&jobTitle=East'
        // ]);

        $this->doSend($copy1, []);
        return 'Email sent';
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function sendStats()
    {
        $users = User::count();
        $sent = User::where('sent', 1)->count();

        return response([
            'sent' => $sent,
            'users' => $users
        ]);
    }

    private function doSend($user, $userCopy = []) {
        try {
            if(!$user->qr) {
                $path = public_path('qrcode/' . $user->email);
                if(!file_exists($path)) mkdir($path, 0777, true);

                $file = "qr.png";
                $filename = $path . "/" . $file;

                if(!file_exists($filename)) {
                    \QrCode::color(255, 0, 127)->format('png')
                        ->size(500)->generate($user->code, $filename);
                }

                $uploadParams = [
                    'resource_type' => 'auto'
                ];
                $path = cloudinary()->upload($filename, $uploadParams)->getSecurePath();
            }
            else $path = $user->qr;

            //
            Mail::to($user)
                ->cc($userCopy)->send(new QrcodeMail($user, $path));

            // Update model
            $user->qr = $path;
            $user->sent = true;

            $user->save();
        }
        catch (\Throwable $e) {
            // info($e->getMessage());
            // throw $th;
        }
    }

    function profile() {
        $user = Auth::user();
        if($user->firstname == 'Admin')
            return redirect('dashboard');

        //
        return view('profile');
    }

    function dashboard() {
        $user = Auth::user();
        if($user->firstname != 'Admin')
            return redirect('profile');

        $users = User::count();
        $all = ClockedIn::count();
        $data = ClockedIn::whereDate('created_at', date('Y-m-d'))
            ->with('user')->paginate(20);

        //
        return view('dashboard', [
            'all' => $all,
            'data' => $data,
            'users' => $users
        ]);
    }
}
