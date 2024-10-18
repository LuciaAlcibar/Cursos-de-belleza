<?php

class AuthView {
    private $user = null;

    public function showLogin($error = '') {
        require_once 'templates/form_login.phtml';
    }

    public function showSignup($error = '') {
        require_once 'templates/form_signup.phtml';
    }
    public function showError($error){
        require_once 'templates/error.phtml';
    }
}
