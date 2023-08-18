<?php

namespace App\Services;

use App\Models\Category;
use Exception;

class CategoryService extends BaseService
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function deleteCascade(int $id): ?bool
    {
        try {
            $record = $this->find($id);
            $record->products()->delete();
            $record->delete();
    
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}