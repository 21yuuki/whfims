<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService extends BaseService
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function logout(): ?bool
    {
        Auth::user()->tokens->each(function ($token, $key){
            $token->delete();
        });

        return true;
    }
}