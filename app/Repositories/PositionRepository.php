<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PositionRepositoryInterface;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class PositionRepository extends AbstractRepository implements PositionRepositoryInterface
{

    public function getModel(): Model
    {
        // TODO: Implement getModel() method.
    }
}
