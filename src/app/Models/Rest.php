<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $fillable = ['timestamp_id', 'start_rest_time', 'end_rest_time', 'diff_rest_time_seconds'];

    public function timestamp()
    {
        return $this->belongsTo(Timestamp::class, 'timestamp_id');
    }
}
