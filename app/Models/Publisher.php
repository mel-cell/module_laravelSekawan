<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'publisher_description'
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'book_publisher_id', 'publisher_id');
    }
}
