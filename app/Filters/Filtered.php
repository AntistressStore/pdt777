<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

trait Filtered
{
    public function scopeFilter(Builder $builder, QueryFilter $filter): void
    {
        $filter->apply($builder);
    }
}
