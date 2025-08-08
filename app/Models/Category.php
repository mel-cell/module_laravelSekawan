<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'category_name',
        'category_description'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_category_id', 'category_id');
    }
}
