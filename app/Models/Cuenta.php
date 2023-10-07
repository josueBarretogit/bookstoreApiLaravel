<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cuenta extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class);
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Rol::class);
    }
}
