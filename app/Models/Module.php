<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory;
    protected $table = 'modules';

    protected $fillable = ['name', 'description', 'key'];

    public function audit_user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'audit_user_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($rec) {
            $rec->audit_user_id = auth()->user()->id;
        });
    }
}
