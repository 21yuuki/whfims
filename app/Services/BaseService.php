<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class BaseService
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'], array $relations = []): array
    {
        $record = $this->model->with($relations)->select($columns)->get();
        return $record->toArray();
    }

    public function find(int $id, array $columns = ['*'], array $relations = []): ?Model
    {   
        return $this->model->with($relations)->findOrFail($id);
    }

    public function save(array $payload): Model
    {
        DB::beginTransaction();
        try {
            $id = $payload['id'] ?? 0;
            if($id != 0) {
                $this->find($id);
            }
            $result = $this->model->updateOrCreate(['id' => $id], $payload);
            DB::commit();
            return $result;
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            throw new Exception('Unable to update non-existing record.', 400);
        } catch (QueryException $e) {
            DB::rollBack();
            throw new Exception($e, 400);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Something went wrong', 500);
        } 
    }

    public function delete(int $id): ?bool
    {
        return $this->find($id)->delete();
    }
}