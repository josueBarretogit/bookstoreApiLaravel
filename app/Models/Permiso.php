<?php

namespace App\Models;

use App\Models\Rol;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class);
    }
}
