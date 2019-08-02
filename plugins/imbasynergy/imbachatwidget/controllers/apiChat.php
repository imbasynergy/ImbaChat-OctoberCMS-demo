<?php namespace ImbaSynergy\imbachatwidget\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Auth;
use RainLab\User\Models\User;
use ImbaSynergy\imbachatwidget\Components\imbaChat;

class apiChat extends Controller
{
    public $implement = [    ];
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getUser($str_ids){
        $login = \Config::get('imbasynergy.imbachatwidget::login');
        $password = \Config::get('imbasynergy.imbachatwidget::password');

        if(!isset($_SERVER['PHP_AUTH_USER']) || ($_SERVER['PHP_AUTH_PW']!=$password) || strtolower($_SERVER['PHP_AUTH_USER'])!=$login)
        {
            header('WWW-Authenticate: Basic realm="Backend"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Authenticate required!';
            die();
        }

        $ids = explode(",", $str_ids);
        $users = array();
        foreach ($ids as $id){
            $user_m = @User::where('id', $id)->get()[0];
            if(!$user_m)
                continue;
            $user = array();
            $user['name'] = $user_m->name;
            $user['user_id'] =  $user_m->id;
            $users[] = $user;
        }
        return json_encode($users);
    }
    public function authUser(){
        try{
            $user_m = Auth::authenticate([
                'login' => post('login'),
                'password' => post('password')
            ]);
        }catch (\October\Rain\Auth\AuthException $e){
            return 'Please enter a correct username and password. Note that both fields may be case-sensitive.';
        }
        $user = array();
        $user['name'] = $user_m['name'];
        $user['user_id'] =  $user_m['id'];
        return $user;
    }
}
