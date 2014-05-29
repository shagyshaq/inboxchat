<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class UsersController extends BaseController {
  

    public function updateOrCreateUser() {
      
            if (Input::get('id')) {
                $user = array(
                    'username' => Input::get('username'),
                    'email' => Input::get('email')
                );

                $message = $this->validateUser($user, 'update');

                if ($message === null) {
                    User::where('id', Input::get('id'))->update($user);
                    return Redirect::to('users/listusers')->with('message', "S-au modificat detaliile Userului!");
                }

                $user_object = new User;
                $user_object->id = Input::get('id');
                $user_object->username = $user['username'];
                $user_object->email = $user['email'];

                return View::make('edituser', array('user' => $user_object, 'validate_messages' => $message));
            } else {
                $user = array(
                    'username' => Input::get('username'),
                    'password' => Input::get('password'),  
                    'password_confirmation' => Input::get('confirmPassword'),
                    'email' => Input::get('email'),
                    'birthday' => Input::get('birthday')
                );
                
                               
                $message = $this->validateUser($user, 'create');
                
                if ($message === null) {
                    User::create(array(
                        'username' => Input::get('username'),
                        'password' => Hash::make(Input::get('password')),
                        'email' => Input::get('email'),
                        'birthday' => Input::get('birthday')
                            )
                    );
                    return Redirect::to('users/login')->with('messageLogin', "Now you can Log In");
                }

                $user_object = new User;
                $user_object->username = $user['username'];
                $user_object->email = $user['email'];
                $user_object->birtday = $user['birthday'];
                return Redirect::back()->with(array('user' => $user_object, 'validate_messages' => $message));
                
            }
    }

    
    public function postSignIn() {

        $credentials = array('username' => Input::get('username'), 'password' => Input::get('password'));

        if (Auth::attempt($credentials)) {
            return Redirect::to('messages/count')->with('message', 'You are now logged in!');
        } else {
            return Redirect::to('users/login')
                            ->with('message', 'Your username/password combination was incorrect')
                            ->withInput();
        }
    }
    
    public function validateUser($user, $type) {
        if ($type == 'create') {
            $validator = Validator::make(
                            $user, array(
                        'username' => 'required',
                        'password' => 'required|min:8|Confirmed',                                
                        'password_confirmation' =>'Required|min:8',
                        'email' => 'required|email|unique:users',
                        'birthday' => array('required', 'date_format:m/d/Y', 'regex:/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/')
                            )
            );
        } elseif ($type == 'update') {
            $validator = Validator::make(
                            $user, array(
                        'username' => 'required',
                        'email' => 'required|email|unique:users',
                        'birthday' => array('required', 'date_format:m/d/Y', 'regex:/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/')
                            )
            );
        }
        if ($validator->fails()) {
            return ($validator->messages());
        } else {
            return null;
        }
    }
    
    public function getLogOut() {
        Auth::logout();
        return Redirect::to('users/login');
    }
    
    public function getDashboard() {
        if (Auth::check()) {
            return View::make('dashboard');
        } else {
            return Redirect::to('users/login')
                            ->with('message', 'Your username/password combination was incorrect')
                            ->withInput();
        }
    }
    
    public function getLogin() {

        return View::make('login');
    }
    
     public function profileUser() {
         if (Auth::check()) {
             $profileDetails = array(
                        'username' => Auth::user()->username,
                        'email' => Auth::user()->email,
                        'birthday' => Auth::user()->birthday,               
             );
             
            return View::make('userProfile')->with(array('userProfile' => $profileDetails));
            
        } else {
            return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        }
     }
    
    public function createUser() {
        if (Auth::check()) {
            return View::make('edituser');            
        } else {
            return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        }
    }

    public function registerUser() {    	
    		return View::make('edituser');    	
    }


}
