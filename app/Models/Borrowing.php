<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

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
        'borrowing_fine',
        'borrowing_borrowed_at',
        'returned_at'
    ];

    protected $casts = [
        'borrowing_returned' => 'boolean',
        'borrowing_borrowed_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'borrowing_user_id', 'id');
    }

    public function borrowingDetails(): HasMany
    {
        return $this->hasMany(BorrowingDetail::class, 'detail_borrowing_id', 'borrowing_id');
    }
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->borrowing_id)) {
                $model->borrowing_id = (string) Str::uuid();
            }
        });
    }
}
