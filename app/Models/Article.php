<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * テーブル設定
     *
     * @var string
     */
    protected $table = 'articles';
    const CREATED_AT = 'register_at';
    const UPDATED_AT = 'update_at';
}
