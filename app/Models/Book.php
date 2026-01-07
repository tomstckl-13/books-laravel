<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    /**
     * Summary of fillable
     * @var list<string>
     */
    protected $fillable =
        [
        'isbn',
        'title',
        'pages',
        'author_id'];

    public function author(): BelongsTo {
       return $this->belongsTo(Author::class);
    }

}
