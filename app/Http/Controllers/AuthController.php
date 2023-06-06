<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function register(){ 
        return view('auth.register'); 
    }

    public function proses_login(Request $request){

        $credentials =  $request->only('email','password');

        $validate = Validator::make($credentials,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }

        if(Auth::attempt($credentials)){
            return redirect()->intended('dashboard')->with('success','Successfully Login');
        }
        
        return redirect('login')->withInput()->withErrors(['login_error'=>'Username or password are wrong!']);
        
    }

    public function dashboard(){ 

        if(Auth::check()){

            $totalCustomer = Customer::all()->count();
            $totalBook = Book::all()->count();
            $totalOrder = Order::all()->count();
            $totalPopular = Book::all()->count();
        
            return view('home',compact('totalCustomer','totalBook','totalOrder','totalPopular'));

        }

        return redirect('login')->with('You dont have access');
      }

    public function proses_register(Request $request){

         $validate = Validator::make($request->all(),[
             'fullname'=>'required',
             'email'=>'required|email|unique:users',
             'password' => 'required|confirmed',
             'password_confirmation' => 'required'
         ]);
 
          if($validate->fails()){
             return back()->withErrors($validate)->withInput();
         }
 
         $request['level'] = 'admin';

         User::create($request->all());

         return redirect('dashboard')->with('success','You have successfully register');
 
 
    }

    public function logout(){

        Session::flush();
        Auth::logout();

        return Redirect('login');
    }


}
