<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

class UsersController extends BaseController {

    public function listUsers() {
        if (Auth::check()) {
            $users = new User();
            $usersData = $users->all()->where();
            return View::make('listusers', array('users' => $usersData));
        } else {
            return Redirect::to('users/login')
                            ->with('messageLogin', 'You need to log in first!');
        }
    }

    public function deactivateUser($id) {
        if (Auth::check()) {
            $user = User::find($id);
            $user->active = '0';
            $user->save();

            return Redirect::to('users/listusers')->with('message', 'Your user is deactivated!');
        } else {
            return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        }
    }

    public function activateUser($id) {
        if (Auth::check()) {
            $user = User::find($id);
            $user->active = '1';
            $user->save();

            return Redirect::to('users/listusers')->with('message', 'Your user is activated!');
        } else {
            return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        }
    }

    
    
    public function editUser($id) {
        if (Auth::check()) {
            $user = new User();
            $userData = $user->find($id);

            return View::make('edituser', array('user' => $userData));
        } else {
            return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        }
    }

    public function deleteUser($id) {
        if (Auth::check()) {
            User::destroy($id);
            return Redirect::to('users/listusers')->with('message', 'Your user is deleted!');
        } else {
            return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        }
    }

    public function updateOrCreateUser() {
      //  if (Auth::check()) {
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
                
                /*$confirmPassword = Input::get('confirmPassword');
                if($confirmPassword != $user['password']) {                    
                    $user_object = new User;
                    $user_object->birthday = Input::get('birthday');
                    $user_object->username = $user['username'];
                    $user_object->email = $user['email'];
                    return Redirect::back()->with(array('user' => $user_object));
                //return View::make('edituser', array('user' => $user_object, 'validate_messages' => $message));
                }*/
                
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
                //return View::make('edituser', array('user' => $user_object, 'validate_messages' => $message));
            }
       /* } else {
            return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        }*/
    }

    
    public function postSignIn() {

        $credentials = array('username' => Input::get('username'), 'password' => Input::get('password'));

        if (Auth::attempt($credentials)) {
            return Redirect::to('users/dashboard')->with('message', 'You are now logged in!');
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
                                
                                //'date_format:d/m/y'
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
    
    public function createUser() {
        if (Auth::check()) {
            return View::make('edituser');
            //return View::make('createuser');
        } else {
            return Redirect::to('users/login')->with('messageLogin', 'You need to log in first!');
        }
    }

    public function registerUser() {    	
    		return View::make('edituser');    	
    }


}
