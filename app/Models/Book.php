<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    use HasFactory;

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    protected $fillable = [
        'name',
        'description',
        'img',
        'docpdf',
        'ISBN',
        'amount',
        'barcode_image',
        'status'
    ];
}

