<?php

namespace App\Models;

// app/Models/Book.php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Author;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $primaryKey = 'book_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'book_id',
        'book_name',
        'book_isbn',
        'book_stock',
        'book_description',
        'book_img',
        'book_category_id',
        'book_publisher_id',
        'book_author_id',
        'book_shelf_id'
    ];

    // Relasi
    public function category()
    {
        return $this->belongsTo(Category::class, 'book_category_id', 'category_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'book_publisher_id', 'publisher_id');
    }

    public function author()
    {
        return $this->belongsTo(Author::class, 'book_author_id', 'author_id');
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class, 'book_shelf_id', 'shelf_id');
    }

    public function borrowingDetails()
    {
        return $this->hasMany(BorrowingDetail::class, 'detail_book_id', 'book_id');
    }
}