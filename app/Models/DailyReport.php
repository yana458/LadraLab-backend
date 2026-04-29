<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'report_date',
        'status',
        'published_at',
        'food_done',
        'walk_done',
        'rest_done',
        'hygiene_done',
        'medication_done',
        'play_done',
        'summary',
        'observations'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
