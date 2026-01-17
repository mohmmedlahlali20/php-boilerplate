<?php

namespace App\Domain\Models;

class User extends Model {
    public $id;
    public $name;
    public $email;
    public $status;
    public $created_at;

    /** * Attributes that are mass-assignable 
     */
    public $fillable = ['name', 'email', 'status'];

    /**
     * Validation rules for the User model
     */
    public function rules(): array {
        return [
            'name'  => 'required|min:3|max:50',
            'email' => 'required|email|unique:users',
            'status'=> 'required|in:active,inactive'
        ];
    }

    public function getShortName() {
        return explode(' ', $this->name)[0];
    }
}