<?php

namespace App\Entities\Visit;

use App\Entities\BaseEntity;
use Database\Factories\Visit\VisitFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitEntity extends BaseEntity
{
    use HasFactory;

    protected $table = 'visits';

    protected static function newFactory()
    {
        return VisitFactory::new();
    }
}