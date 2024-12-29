<?php

namespace App\Services;

use App\Models\House;

class HouseDbUpdateService
{
    // use safe insert. Commit only if no errors
    public function insert(array $elements): void
    {
        \DB::beginTransaction();

        try {
            House::insert($elements);

            \DB::commit();
        } catch (\Throwable $e) {
            \DB::rollback();
            // In future big not test work, error handling should be placed in a separate class or function.
            throw $e;
        }
    }
}
