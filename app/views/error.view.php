<?php
class errorView {
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }

    public function showError($error) {

        require_once 'templates/error.phtml';
    }
}
