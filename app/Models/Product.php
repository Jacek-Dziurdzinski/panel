<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function offers(){

return $this->belongsTo(Offer::class, 'ean', 'ean'); // lączy tabele products z tabelą offers po numerze ean

    }

    public function producers(){

        return $this->belongsTo(Producer::class, 'producer', 'id'); // lączy tabele products z tabelą offers po numerze ean
        
            }

}
