<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class EntityService extends Pivot
{
    use HasFactory;

    protected $table ='entity_service';

    protected $fillable = [

        'quantity'

    ];




}
