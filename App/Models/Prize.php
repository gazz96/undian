<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    protected $table = "prizes";

    protected $fillable = [
        'name',
        'drawing_id',
        'prize_id',
        'description',
        'image'
    ];

    public function drawing()
    {
        return $this->belongsTo(Drawing::class, 'drawing_id');
    }
}