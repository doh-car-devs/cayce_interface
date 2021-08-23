<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Traits\CurlNow;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User, App\Division, App\Section, App\Program, App\UserLink;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use CurlNow;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function showLoginForm()
    {
            // if (!Auth::check()) {
            //     return redirect()->back()->with('error', 'You are already logged in');
            // }
        return view('auth.login');
    }

    protected function getCredentials(Request $request)
    {
        return [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
    }

    protected function login(Request $request)
    {
        $this->validate($request,['email' => 'required|email','password' => 'required']);
        // dd( auth()->user());
        if (Auth::guard()->attempt($this->getCredentials($request))){

            $access_tokens = auth()->user()->access_tokens;
            // $access_tokens = unserialize(base64_decode($access_tokens));
            $link_group = DB::table('user_links')
                ->select('link_group', DB::raw('count(*) as total'))
                ->where('user_links.user_id', '=' , auth()->user()->id)
                ->groupBy('link_group')
                ->get();
            $user_api = DB::table('user_links')
                ->where('link', 'like', 'api.%')->where('user_id', auth()->user()->id)->get();
            $user_pages = DB::table('user_links')
                ->where('link', 'not like', 'api.%')->where('user_id', auth()->user()->id)->get();

            // $mySection =    Section::where('id', auth()->user()->section_id)->first();
            // $myDivision =   Division::where('id', auth()->user()->division_id)->first();

            session(['user_api' => $user_api]);
            session(['user_links' =>  $user_pages]);
            session(['user_link_group' =>  $link_group]);
            session(['access_tokens' =>  $access_tokens]);
            session(['directorIV' =>  User::where('access_group', '101')->first()]);
            session(['directorIII' =>  User::where('access_group', '100')->first()]);
            session(['division_chief' =>  User::where(['access_group' => '98', 'division_id' => auth()->user()->division_id])->first()]);
            session(['section_head' =>  User::where(['access_group' => '97', 'section_id' => auth()->user()->section_id])->first()]);
            session(['section' =>  Section::where('id', auth()->user()->section_id)->first()]);
            session(['division' =>  Division::where('id', auth()->user()->division_id)->first()]);

            session(['lastActivity' =>  User::where('id', auth()->user()->id)->first()->lastActivity]);
            // dd(request()->ip());
            DB::table('users')->where('id', auth()->user()->id)->update(['lastActivity' => Carbon::now()]);

            return redirect()->route('dashboard')->with('welcome', 'Welcome back '. auth()->user()->name.' !');
        }
        return redirect()->back()->with('error', 'Please check your email and password and try again.');
    }

    protected function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
