<?php declare( strict_types = 1 );

namespace App;

class User {
    private String $username;
    private String $password;
    private String $email;


    function __construct(String $username, String $password, String $email) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }

    public function login() : bool {
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


?>