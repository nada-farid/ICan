<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    public $table = 'comments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'email',
        'comment',
        'post_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function post()
    {
        return $this->belongsTo(PublicSubject::class, 'post_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
