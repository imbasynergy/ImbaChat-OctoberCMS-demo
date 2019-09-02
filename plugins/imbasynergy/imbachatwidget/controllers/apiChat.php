<?php namespace ImbaSynergy\imbachatwidget\Controllers;

use Backend\Classes\Controller;
use Auth;
use RainLab\User\Models\User;
use ImbaSynergy\imbachatwidget\Models\Settings;

class apiChat extends Controller
{
    public $implement = [    ];
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * API authorization check
     */
    protected function testAuthOrDie()
    {
        $login = Settings::get('dev_login');
        $password = Settings::get('dev_password');

        if(!isset($_SERVER['PHP_AUTH_USER'])
                || ($_SERVER['PHP_AUTH_PW']!=$password) 
                || strtolower($_SERVER['PHP_AUTH_USER'])!=$login)
        {
            header('WWW-Authenticate: Basic realm="Backend"');
            header('HTTP/1.0 401 Unauthorized');
            echo json_encode([
                "code" => 401,
                "error" => 'Authenticate required!',
                'debug' => ''
            ]); 
            die();
        }
    }
    
    /**
     * API chat integration. Provides information about the user by his id
     * 
     * @param string $str_ids
     * @return array
     */
    public function getUsers($str_ids){
        
        $this->testAuthOrDie();
        $ids = explode(",", $str_ids);
        $users = [];
        
        $res = User::whereIn('id', $ids)->get(); 
        foreach ($res as $user_m){ 
            $user = [];
            $user['name'] = $user_m->name;
            $user['user_id'] =  $user_m->id; 
            $users[] = $user;
        }
        
        return $users;
    }
    
    /**
     * API chat integration. Provides information about the user by his login and password
     * 
     * @param string $str_ids
     * @return array
     */
    public function authUser(){
        
        $this->testAuthOrDie();
        
        try{
            $user_m = Auth::authenticate([
                'login' => post('login'),
                'password' => post('password')
            ]);
        }catch (\October\Rain\Auth\AuthException $e){
            return [
                "code" => 403,
                "error" => 'Please enter a correct username and password. Note that both fields may be case-sensitive.',
                'debug' => ''
            ];
        }
        
        $user = array();
        $user['name'] = $user_m['name'];
        $user['user_id'] =  $user_m['id'];
        return $user;
    }
    
    
    /**
     * API chat integration. 
     * Provides information about the users by search string 
     * @return array
     */
    public function usersSearch($key){
        
        $this->testAuthOrDie();
        //если поиск производиться через email
        $users_m = User::where('name', 'like', $key.'%')->get();
        $users = array();
        $users['code'] = 200;
        $users['version'] = 2;
        foreach ($users_m as $user_m) {
            $user = array();
            $user['name'] = $user_m['name'];
            $user['user_id'] =  $user_m['id'];
            $user['email'] =  $user_m['email'];
            $users['data'][] = $user;
        }
        return $users;
    }
    
    /**
     * API chat integration. 
     * Provides information about api version
     * @return array 
     */
    public function getApiVersion(){
      
        $this->testAuthOrDie();
        return [
            "version" => 1.0,
            "type" => "OctoberCMS plugin"
        ];
    }
}
