<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $table = 'entity';

    protected $fillable = [

        'name',
        'phone',
        'mail',
        'address',
        'website',

    ];

    public function services(){

        return $this->belongsToMany(Service::class)
                    ->using(EntityService::class)
                    ->withPivot('quantity');

    }

    public function employees(){

        return $this->hasMany(Employee::class);

    }

    public function tickets(){

        return $this->hasMany(Ticket::class);

    }

}
