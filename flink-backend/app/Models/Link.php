<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'lien', 'place']; // Attributs remplissables
    // Définir la relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
