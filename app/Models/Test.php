<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    const TABLE = 'articles';
    protected $table = self::TABLE;


    public function id(): string
    {
        return (string) $this->id;
    }

    public function title(): string
    {
        return 'Sezer Bölük-'. $this->title;
    }

    public function slug(): string
    {
        return $this->slug;
    }
}
