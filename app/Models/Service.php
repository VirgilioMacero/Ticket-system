<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [

        'name',
        'description'

    ];

    public function entity()
    {
        return $this->belongsToMany(Entity::class)
                    ->using(EntityService::class)
                    ->withPivot('quantity');
    }

    public function areaServices(){

        return $this->belongsTo(AreaService::class,'area_service_id');

    }

    public function tickets(){

        return $this->hasMany(Ticket::class);

    }

}
