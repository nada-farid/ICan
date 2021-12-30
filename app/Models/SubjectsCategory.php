<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectsCategory extends Model
{
    use SoftDeletes;

    public $table = 'subjects_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function subjectCategoryPublicSubjects()
    {
        return $this->hasMany(PublicSubject::class, 'subject_category_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
