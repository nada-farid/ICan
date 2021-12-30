<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class VideosParticipate extends Model implements HasMedia
{
    use SoftDeletes;
    use HasMediaTrait;

    public const TYPE_SELECT = [
        'upload_video' => 'Upload Video',
        'youtube'      => 'Embed From Youtube',
    ];

    public $table = 'videos_participates';

    public const STATUS_SELECT = [
        'pending'  => 'قيد الأنتظار',
        'accepted' => 'مقبول',
        'refused'  => 'مرفوض',
    ];
    
    protected $appends = [
        'video',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'type',
        'embed_code',
        'status',
        'user_id',
        'practical_solution_id',
        'champion_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getVideoAttribute()
    {
        return $this->getMedia('video')->last();
    }

    public function practical_solution()
    {
        return $this->belongsTo(PracticalSolution::class, 'practical_solution_id');
    }

    public function champion()
    {
        return $this->belongsTo(Champion::class, 'champion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}