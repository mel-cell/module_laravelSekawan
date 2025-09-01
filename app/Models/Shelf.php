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

    protected $casts = [
        'shelf_position' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->shelf_id)) {
                $model->shelf_id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'book_shelf_id', 'shelf_id');
    }

    // custom method to get all shelves with pagination

    public static function getAllShelves($perPage = 10)
    {
        return self::paginate($perPage);
    }

    public static function createNewShelf(array $data)
    {
        return self::create($data);
    }

    public static function updateExistingShelf(array $data, string $shelfId)
    {
        $shelf = self::find($shelfId);
        if ($shelf) {
            $shelf->update($data);
        }
        return $shelf;
    }

    public static function deleteShelfById(string $shelfId)
    {
        $shelf = self::find($shelfId);
        if ($shelf) {
            return $shelf->delete();
        }
        return null;
    }

    public static function findShelfById(string $shelfId)
    {
        return self::find($shelfId);
    }
}
