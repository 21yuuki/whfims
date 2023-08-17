<?php

namespace App\Services;

use App\Models\Table;

class TableService extends BaseService
{
    public function __construct(Table $model)
    {
        parent::__construct($model);
    }
}