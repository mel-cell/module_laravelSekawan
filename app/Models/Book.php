<?php

namespace App\Models;

// app/Models/Book.php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Shelf;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->book_id)) {
                $model->book_id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    // Relasi
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'book_category_id', 'category_id');
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class, 'book_publisher_id', 'publisher_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'book_author_id', 'author_id');
    }

    public function shelf(): belongsTo
    {
        return $this->belongsTo(Shelf::class, 'book_shelf_id', 'shelf_id');
    }

    public function borrowingDetails(): hasMany
    {
        return $this->hasMany(BorrowingDetail::class, 'detail_book_id', 'book_id');
    }

    // --- CUSTOM METHODS UNTUK OPERASI CRUD ---

    public static function getAllBooks($perPage = 10)
    {
        // Menggunakan with() untuk eager loading relasi Author, Publisher, Category, dan Shelf
        // Ini mencegah masalah N+1 query saat menampilkan data relasi di view
        return self::with(['author', 'publisher', 'category', 'shelf'])->paginate($perPage);
    }

    public static function createNewBook(array $data)
    {
        return self::create($data);
    }

    public static function updateExistingBook(array $data, string $bookId)
    {
        $book = self::find($bookId);
        if ($book) {
            $book->update($data);
        }
        return $book;
    }

    public static function deleteBookById(string $bookId)
    {
        $book = self::find($bookId);
        if ($book) {
            return $book->delete();
        }
        return null;
    }

    public static function findBookById(string $bookId)
    {
        return self::find($bookId);
    }
}