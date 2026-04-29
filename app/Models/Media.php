<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_report_id',
        'file_path',
        'file_type',
        'uploaded_at'
    ];

    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class);
    }
}
