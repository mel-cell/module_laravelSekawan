<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Penting untuk Str::uuid()

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';
    protected $primaryKey = 'author_id';

    // Set $incrementing menjadi false karena kita menggunakan UUID (string)
    public $incrementing = false;
    // Set $keyType menjadi 'string' untuk UUID
    protected $keyType = 'string';
    // Laravel secara otomatis mengelola created_at dan updated_at
    public $timestamps = true; 

    // Kolom yang dapat diisi secara mass assignment.
    // author_id tidak perlu di sini karena digenerate otomatis di boot().
    protected $fillable = [
        'author_name',
        'author_description'
    ];

    /**
     * Definisi relasi One-to-Many: Satu Author memiliki banyak Books.
     * Sesuaikan foreign key jika berbeda dari konvensi Laravel.
     */
    public function books()
    {
        // Sesuaikan 'book_author_id' jika nama foreign key di tabel books berbeda
        // Sesuaikan 'author_id' jika nama primary key di tabel authors berbeda
        return $this->hasMany(Book::class, 'book_author_id', 'author_id');
    }

    /**
     * Boot method untuk Model.
     * Digunakan untuk menghasilkan UUID secara otomatis saat membuat data baru.
     */
    protected static function boot()
    {
        parent::boot();

        // Saat model sedang dibuat (sebelum disimpan ke DB),
        // isi author_id dengan UUID jika belum ada.
        static::creating(function ($author) {
            if (empty($author->{$author->getKeyName()})) {
                $author->{$author->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // --- CUSTOM METHODS UNTUK OPERASI CRUD ---

    /**
     * Mengambil semua data penulis dengan pagination.
     * Digunakan oleh AuthorController untuk operasi Read.
     *
     * @param int $perPage Jumlah data per halaman.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getAllAuthors($perPage = 10)
    {
        return self::paginate($perPage);
    }

    /**
     * Membuat data penulis baru.
     * Digunakan oleh AuthorController untuk operasi Create.
     *
     * @param array $data Data yang akan disimpan (sudah divalidasi).
     * @return \App\Models\Author
     */
    public static function createNewAuthor(array $data)
    {
        return self::create($data);
    }

    /**
     * Memperbarui data penulis yang sudah ada.
     * Digunakan oleh AuthorController untuk operasi Update.
     *
     * @param array $data Data baru untuk penulis (sudah divalidasi).
     * @param string $authorId ID penulis yang akan diperbarui.
     * @return \App\Models\Author|null Mengembalikan instance Author yang diperbarui, atau null jika tidak ditemukan.
     */
    public static function updateExistingAuthor(array $data, string $authorId)
    {
        $author = self::find($authorId); // Mencari penulis berdasarkan ID
        if ($author) {
            $author->update($data); // Memperbarui data
        }
        return $author;
    }

    /**
     * Menghapus data penulis.
     * Digunakan oleh AuthorController untuk operasi Delete.
     *
     * @param string $authorId ID penulis yang akan dihapus.
     * @return bool|null Mengembalikan true jika berhasil dihapus, false jika gagal, atau null jika tidak ditemukan.
     */
    public static function deleteAuthorById(string $authorId)
    {
        $author = self::find($authorId); // Mencari penulis berdasarkan ID
        if ($author) {
            return $author->delete(); // Menghapus data
        }
        return null;
    }

    /**
     * Mencari penulis berdasarkan ID.
     * Dapat digunakan jika controller atau bagian lain perlu mengambil satu penulis saja.
     *
     * @param string $authorId ID penulis.
     * @return \App\Models\Author|null Mengembalikan instance Author, atau null jika tidak ditemukan.
     */
    public static function findAuthorById(string $authorId)
    {
        return self::find($authorId);
    }
}
