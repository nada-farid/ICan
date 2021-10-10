<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Champion extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;

    public const DEGREE_SELECT = [
        'Literate without Certificate' => 'القراءة والكتابة بدون شهادة',
        'Primary Certificate'          => 'الشهادة الابتدائية',
        'middle school certificate'    => 'شهادة المدرسة المتوسطة',
        'High School Certificate'      => 'شهادة الثانوية العامة',
        'Diploma'                      => 'شهادة دبلوم',
        'Bachelors Degree'             => 'درجة الليسانس',
        'Masters Degree'               => 'ماجيستير',
        'PhD'                          => 'الدكتوراه',
    ];

    public $table = 'champions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'photo',
        'tournament_photo',
        'tournament_videos',
    ];

    protected $fillable = [
        'name',
        'age',
        'brief',
        'degree',
        'other_skills',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function getTournamentPhotoAttribute()
    {
        $files = $this->getMedia('tournament_photo');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    public function getTournamentVideosAttribute()
    {
        return $this->getMedia('tournament_videos');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
