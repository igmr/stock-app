<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    use HasFactory, SoftDeletes;
    // ********************************************************************* //
    // * TABLE                                                             * //
    // ********************************************************************* //
    protected $table = "follows";
    protected $primaryKey = 'id';
    public $incrementing  = true;
    protected $keyType    = true;
    // ********************************************************************* //
    // * ATTRIBUTES                                                        * //
    // ********************************************************************* //
    protected $fillable = [
        'id', 'user_id', 'maintenance_id', 'observation', 'status'
    ];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
    protected $casts = [
        'id'             => 'integer',
        'user_id'        => 'integer',
        'maintenance_id' => 'integer',
        'observation'    => 'string',
        'status'         => 'string',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
        'deleted_at'     => 'datetime',
    ];
    // ********************************************************************* //
    // * RELATIONSHIP                                                      * //
    // ********************************************************************* //
    // * Follow -> 1:1 -> Maintenance
    public function maintenance(): BelongsTo
    {
        return $this->belongsTo(Maintenance::class);
    }
    // * Follow -> 1:1 -> User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
