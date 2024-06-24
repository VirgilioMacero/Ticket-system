<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    protected $table = 'problems';

    protected $fillable = [
        'description',
        'solution'
    ];

    public function tickets(){

        return $this->belongsTo(Ticket::class);

    }

}
