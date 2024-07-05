<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance extends Model
{
    use HasFactory, SoftDeletes;
    // ********************************************************************* //
    // * TABLE                                                             * //
    // ********************************************************************* //
    protected $table = "maintenances";
    protected $primaryKey = 'id';
    public $incrementing  = true;
    protected $keyType    = true;
    // ********************************************************************* //
    // * ATTRIBUTES                                                        * //
    // ********************************************************************* //
    protected $fillable = [
        'id', 'user_id', 'printer_id', 'internal',
        'date_init', 'date_finish', 'date_cancel',
        'user_name', 'cost',
        'observation_init', 'observation_finish', 'observation_cancel',
        'status', 'created_at',
    ];
    protected $hidden = [
        'updated_at', 'deleted_at',
    ];
    protected $casts = [
        'id'                 => 'integer',
        'user_id'            => 'integer',
        'printer_id'         => 'integer',
        'internal'           => 'boolean',
        'date_init'          => 'datetime',
        'date_finish'        => 'datetime',
        'date_cancel'        => 'datetime',
        'user_name'          => 'string',
        'cost'               => 'double',
        'observation_init'   => 'string',
        'observation_finish' => 'string',
        'observation_cancel' => 'string',
        'status'             => 'string',
        'created_at'         => 'datetime',
        'updated_at'         => 'datetime',
        'deleted_at'         => 'datetime',
    ];
    // ********************************************************************* //
    // * RELATIONSHIP                                                      * //
    // ********************************************************************* //
    // * Maintenance -> 1:N -> Archive
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
    // * Maintenance -> 1:N -> Follow
    public function follows(): HasMany
    {
        return $this->hasMany(Follow::class);
    }
    // * Maintenance -> 1:1 -> Printer
    public function printer(): BelongsTo
    {
        return $this->belongsTo(Printer::class);
    }
    // * Maintenance -> 1:1 -> User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
