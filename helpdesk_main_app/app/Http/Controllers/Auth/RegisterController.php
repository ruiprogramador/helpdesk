<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers; // RegistersUsers trait

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $params = [
        'except' => 'logout',
        'action' => 'register'
    ];

    /**
     * Execute an action on the controller.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    /*public function callAction($method, $parameters)
    {

        // dd($method);

        $this->params['action'] = 'register';
        $this->params['except'] = 'logout';

        // return $this->{$method}(...array_values($parameters));
        if(
            1 == 1
            && $method == 'showRegistrationForm'
        )
        {
            return view('auth.auth_user', ['params' => $this->params]);
        }else{
            if(
                1 == 1
                && $method == 'register'
            ){
                //return view('auth.auth_user', ['params' => $this->params]);

                //dd($parameters);

                $request = REQUEST::capture();
                $parameters = $request->all();
                $this->register($parameters);
            }else{
                dd("Error: Invalid method");
            }
        }
    }*/

    public function showRegistrationForm()
    {
        return view('auth.auth_user', ['params' => $this->params]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', $this->params);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);
    // }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    public function register(Request $request)
    {
        $registerRequest = new RegisterRequest();

        if (
            1 == 1
            && $registerRequest->authorize()
        ) {

            //dd($request->all());

            $validation = $registerRequest->validate($request->all());

            if (
                1 == 1
                && $validation->fails()
            ) {

                return redirect()->back()
                    ->withErrors($validation)
                    ->withInput();
            }

            // dd($request->all());

            $user = new User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with([
                'success' => 'You have successfully registered'
            ]);
        } else {
            return redirect()->route('register')->with([
                'error' => 'You are not authorized to register'
            ]);
        }
    }
}
