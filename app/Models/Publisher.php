<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publisher extends Model
{
    use HasFactory;

    protected $table = 'publishers';
    protected $primaryKey = 'publisher_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'publisher_id',
        'publisher_name',
        'publisher_deskription'
    ];


     /**
     * Boot method untuk Model.
     * Digunakan untuk menghasilkan UUID secara otomatis saat membuat data baru.
     */

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($publisher) {
            if (empty($publisher->{$publisher->getKeyName()})) {
                $publisher->{$publisher->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // --- CUSTOM METHODS UNTUK OPERASI CRUD ---

    public static function getAllPublishers($perPage = 10)
    {
        return self::paginate($perPage);
    }

    public static function createNewPublisher(array $data)
    {
        return self::create($data);
    }

    public static function updateExistingPublisher(array $data, string $publisherId)
    {
        $publisher = self::find($publisherId);
        if ($publisher) {
            $publisher->update($data);
        }
        return $publisher;
    }

    public static function deletePublisherById(string $publisherId)
    {
        $publisher = self::find($publisherId);
        if ($publisher) {
            return $publisher->delete();
        }
        return null;
    }

    public static function findPublisherById(string $publisherId)
    {
        return self::find($publisherId);
    }

    // --- RELATIONSHIPS ---
    public function books()
    {
        return $this->hasMany(Book::class, 'book_publisher_id', 'publisher_id');
    }
}
