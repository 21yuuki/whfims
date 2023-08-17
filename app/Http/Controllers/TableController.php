<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TableService;
use Log;

class TableController extends Controller
{
    private $request;
    private $service;

    public function __construct(Request $request, TableService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function all()
    {
        return response()->json($this->service->all());
    }

    public function find(int $id)
    {
        return response()->json($this->service->find($id));
    }

    public function save()
    {
        return response()->json($this->service->save($this->request->toArray()));
    }

    public function delete(int $id)
    {
        $deleted = $this->service->delete($id);
        if($deleted === true) {
            return response()->json(['message' => 'Table successfully deleted.'], 200);
        }
    }
}
