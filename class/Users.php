<?php 

namespace App;

class Users extends ActiveRecord{

    protected static $db;
    protected static $colDB = ['id', 'username', 'password', 'email'];
    protected static $tabla = 'users';

    public String $username;
    public String $password;
    public String $email;



    function __construct($args = []) {
        $this->username = $args['username'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->email = $args['email'] ?? '';
    }

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function login() : bool {
        $data = $this->sanitizeData();


        if (!$data['username'] || !$data['password']) {
            static::$errors[] = 'Completa correctamente el formulario';
        }
        if (empty(static::$errors)) {
            $user_data =  static::find(null, $data['username']);
            
            if (isset($user_data)) {
                $auth = password_verify($this->password, $user_data->password);

                if ($auth) {
                    session_start();

                    $_SESSION['username'] = $user_data->username;
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                } else {
                    static::$errors[] = 'Credenciales erróneas';
                }

            } else {
                static::$errors[] = 'El usuario no existe';
            }
            
        } 

        
        return true;
    }

    public function register() : bool {
        return true;
    }


    public function logout() : bool {
        return false;
    }

    public function changePassword(String $password) : bool {
        return true;
    }

    public function authenticate() : bool {
        return true;
    }

    public function deleteUser() : bool {
        return true;
    }


    

}


