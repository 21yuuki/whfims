<?php

namespace App\Services;

use App\Models\Table;

class TableService extends BaseService
{
    public function __construct(Table $model)
    {
        parent::__construct($model);
    }

    public function getAllAvailableTables(): array
    {
        $record = Table::where('availability', 1)->get();
        return $record->toArray();
    }
}