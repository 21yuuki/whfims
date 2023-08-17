<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use Log;

class UserController extends Controller
{
    private $request;
    private $service;

    public function __construct(Request $request, UserService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function all()
    {
        return response()->json($this->service->all(['*'], ['role']));
    }

    public function find(int $id)
    {   
        return response()->json($this->service->find($id, ['*'], ['role']));
    }

    public function save()
    {
        return response()->json($this->service->save($this->request->toArray()));
    }

    public function delete(int $id)
    {
        $deleted = $this->service->delete($id);
        if($deleted === true) {
            return response()->json(['message' => 'User successfully deleted.'], 200);
        }
    }

    public function getAuthenticatedUser()
    {
        return response()->json($this->service->find(Auth::id()));
    }

    public function logout()
    {
        $logout = $this->service->logout();
        if($logout === true) {
            return response()->json(['message' => 'User logged out.'], 200);
        }
    }
}
