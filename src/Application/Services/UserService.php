<?php

namespace App\Application\Services;

use App\Application\Repositories\UserRepository;

class UserService {
    private $userRepository;

    // Dependency Injection via Constructor
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAllActiveUsers() {
        // Hna t9der t-zid chi logic (Filter, Sort, etc.)
        $users = $this->userRepository->getAllUsers();
        
        return array_map(function($user) {
            $user['name'] = strtoupper($user['name']); // Exemple dyal business logic
            return $user;
        }, $users);
    }
}