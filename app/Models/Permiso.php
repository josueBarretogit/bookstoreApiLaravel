<?php

namespace App\Models;

use App\Models\Rol;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Permiso extends Model
{
    use HasFactory;

    protected $table = 'permisos';
    protected $primaryKey = 'id';
    protected $fillable = ['nombrePermiso'];
    public $timestamps = false;

    public function rol(): HasOne
    {
        return $this->hasOne(Rol::class);
    }
}
