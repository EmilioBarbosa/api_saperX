<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
    ];

    /**
     * Função da relação com o User
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
