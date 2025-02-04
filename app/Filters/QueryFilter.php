<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Builder
     */
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder): void
    {
        $this->builder = $builder;

        foreach ($this->fields() as $field => $value) {
            $method = $field;
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], (array) $value);
            }
        }
    }

    protected function fields(): array
    {
        return \array_filter(
            array_map('trim', $this->request->all())
        );
    }
}
