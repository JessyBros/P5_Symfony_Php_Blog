<?php
namespace App\Services;

class SessionObject
{
    public $admin;
    public $connecter;
    public $id;

    public function __construct() {
        $this->admin = &$_SESSION;
        $this->connecter = &$_SESSION;
        $this->id = &$_SESSION;
