<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';
    protected $primaryKey = 'borrowing_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;

    protected $fillable = [
        'borrowing_id',
        'borrowing_user_id',
        'borrowing_returned',
        'borrowing_notes',
        'borrowing_fine'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'borrowing_user_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(BorrowingDetail::class, 'detail_borrowing_id', 'borrowing_id');
    }
}
