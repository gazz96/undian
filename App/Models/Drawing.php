<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drawing extends Model
{
    protected $table = "drawings";

    protected $fillable = [
        'name',
        'duration',
        'status',
        'background'
    ];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
    
}