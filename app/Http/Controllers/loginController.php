<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Routing\Redirector;
use Illuminate\Auth\Guard as Auth;
use Illuminate\Contracts\View\Factory as View;

class loginController extends Controller
{

    protected $redirector;
    protected $request;
    protected $auth;
    protected $view;


    public function __construct(Redirector $redirector, Request $request, Auth $auth, View $view)
    {
        $this->redirector = $redirector;
        $this->request = $request;
        $this->auth = $auth;
        $this->view = $view;
    }

    public function getLogin() {
        return $this->view->make('auth.login');
    }


    public function postLogin() {
        $credentials = $this->request->only(['email', 'password']);
        $remember = $this->request->get('remember');

        if ($this->auth->attempt($credentials, $remember)) {
            return $this->redirector->home();
        } else {
            $message = trans('auth.login_error');
            return $this->redirector->back()->withErrors([$message])->withInput();
        }

    }

    public function logout() {
        $this->auth->logout();
        return $this->redirector->home();
    }

}
