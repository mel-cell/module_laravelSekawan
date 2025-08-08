<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $primaryKey = 'author_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'author_id',
        'author_name',
        'author_description'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_author_id', 'author_id');
    }
}
