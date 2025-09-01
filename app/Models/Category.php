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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->category_id)) {
                $model->category_id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'book_category_id', 'category_id');
    }

    // commented out custom method to get all categories with pagination
    public static function getAllCategories($perPage = 10)
    {
        return self::paginate($perPage);
    }

    public static function createNewCategory(array $data)
    {
        return self::create($data);
    }

    public static function updateExistingCategory(array $data, string $categoryId)
    {
        $category = self::find($categoryId);
        if ($category) {
            $category->update($data);
        }
        return $category;
    }

    public static function deleteCategoryById(string $categoryId)
    {
        $category = self::find($categoryId);
        if ($category) {
            return $category->delete();
        }
        return null;
    }

    public static function findCategoryById(string $categoryId)
    {
        return self::find($categoryId);
    }
}
