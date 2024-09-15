<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = "participants";

    protected $fillable = [
        'name',
        'drawing_id',
        'prize_id',
        'name',
        'nipp',
        'subarea',
        'winner'
    ];

    public function drawing()
    {
        return $this->belongsTo(Drawing::class, 'drawing_id');
    }
}