<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    use HasFactory;

    protected $table = 'shelves';
    protected $primaryKey = 'shelf_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'shelf_id',
        'shelf_name',
        'shelf_position'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_shelf_id', 'shelf_id');
    }
}
