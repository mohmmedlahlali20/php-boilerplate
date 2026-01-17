<?php

namespace App\Application\Controllers;

use App\Application\Services\UserService;
use App\Application\Repositories\UserRepository;

class UserController {
    private $userService;

    public function __construct() {
        $this->userService = new UserService(new UserRepository());
    }

    public function index() {
        $users = $this->userService->getAllActiveUsers();
        
        // Bla ma d-ir Bootstrap::initView()->render()...
        return view('users/list', ['users' => $users]);
    }
}