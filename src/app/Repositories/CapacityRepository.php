<?php

namespace App\Repositories;

use App\Models\Capacity;
use Illuminate\Database\Eloquent\Collection;

class CapacityRepository implements CapacityRepositoryInterface
{
    public function getAllCapacities(): Collection
    {
        return Capacity::all();
    }
}
