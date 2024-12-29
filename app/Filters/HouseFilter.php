<?php

namespace App\Filters;

class HouseFilter extends QueryFilter
{
    public function name(string $name): void
    {
        $this->builder->where('name', 'LIKE', "%{$name}%");
    }

    public function price(int $price): void
    {
        $this->builder->whereBetween('price', $price);
    }

    public function bedrooms(int $count): void
    {
        $this->builder->where('bedrooms', $count);
    }

    public function bathrooms(int $count): void
    {
        $this->builder->where('bathrooms', $count);
    }

    public function storeys(int $count): void
    {
        $this->builder->where('storeys', $count);
    }

    public function garages(int $count): void
    {
        $this->builder->where('garages', $count);
    }
}