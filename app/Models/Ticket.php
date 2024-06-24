<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $fillable = [

        'title',
        'type'

    ];

    public function user(){

        return $this->belongsTo(User::class);

    }    
    public function entity(){

        return $this->belongsTo(Entity::class,'entity_id');

    }  
    
    public function employee(){

        return $this->belongsTo(Employee::class);

    }

    public function problem(){

        return $this->hasOne(Problem::class);

    }

    public function status(){

        return $this->hasOne(Status::class);

    }
    
    public function service(){

        return $this->belongsTo(Service::class);

    }

}
