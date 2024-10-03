<?php

namespace App\Support\Eloquent\Filter\Contracts;

interface QueryFilter
{
    public function __invoke($query, $field, $value);
}