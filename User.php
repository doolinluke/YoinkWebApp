<?php

/* This creates instances for the user class */

class User {

    private $username;
    private $password;

    /* The following is a constructor for username and password */

    public function __construct($u, $p) {
        $this->username = $u;
        $this->password = $p;
    }

    /* Gets the username entered on the index page */

    public function getUsername() {
        return $this->username;
    }

    /* Gets the password entered on the index page */

    public function getPassword() {
        return $this->password;
    }

}
