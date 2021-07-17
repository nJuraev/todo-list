<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['text','priority','user_id','status'];

    protected $dates = ['created_at','updated_at'];

    public function getCreatedAtAttribute($value)
    {
        Log::info($value);
        return Carbon::parse($value)->format('Y-m-d H:i');
    }
}
