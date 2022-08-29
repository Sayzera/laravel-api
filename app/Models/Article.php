<?php
//AngelJay Academy

namespace App\Models;

use App\Traits\HasAuthor;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasAuthor, ModelHelpers;
    const TABLE = 'articles';
    protected $table = self::TABLE;

    /**
     * Bu alanlar top atanabilr alanlardır 
     * yani create method kullanılarak hepsi bir seferde gönderilebilir
     */
    protected $fillable = [
        'title',
        'slug',
        'body',
        'author_id',
    ];

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
