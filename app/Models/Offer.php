<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;


    public function products(){

        return $this->belongsTo(Product::class, 'ean', 'ean'); // lączy tabele products z tabelą offers po numerze ean
        
        
            }
}
