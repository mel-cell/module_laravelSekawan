<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingDetail extends Model
{
    use HasFactory;

    protected $table = 'borrowing_details';
    protected $primaryKey = 'detail_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'detail_id',
        'detail_borrowing_id',
        'detail_book_id',
        'detail_quantity'
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class, 'detail_borrowing_id', 'borrowing_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'detail_book_id', 'book_id');
    }
}
