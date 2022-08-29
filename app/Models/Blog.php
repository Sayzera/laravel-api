<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'author_id',
    ];

    const TABLE = 'articles';
    protected $table = self::TABLE;

    public function id(): string
    {
        return (string) $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function authorId(): string
    {
        return (string) $this->author_id;
    }


}
