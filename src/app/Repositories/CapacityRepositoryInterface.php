<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface CapacityRepositoryInterface
{
    public function getAllCapacities(): Collection;
}
