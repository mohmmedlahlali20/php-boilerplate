<?php

namespace App\Application\Controllers;

use App\Application\Services\UserService;
use App\Application\Repositories\UserRepository;

// Inherit men l-Base Controller dyalna
class UserController extends Controller {
    private $userService;

    public function __construct() {
        // Mazal f l-mustaqbal n9dro n-diro Container bach i-injecti hadchi automatique
        $this->userService = new UserService(new UserRepository());
    }

    public function index() {
        $users = $this->userService->getAllActiveUsers();
        
        // Sta3mel l-helper view() li derti dba, rah khdam s7i7 m3a l-Bootstrap jdid
        return view('users/list', [
            'title' => 'User Management',
            'users' => $users
        ]);
    }
}