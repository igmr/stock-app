<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Printer extends Model
{
    use HasFactory, SoftDeletes;
    // ********************************************************************* //
    // * TABLE                                                             * //
    // ********************************************************************* //
    protected $table = "printers";
    protected $primaryKey = 'id';
    public $incrementing  = true;
    protected $keyType    = true;
    // ********************************************************************* //
    // * ATTRIBUTES                                                        * //
    // ********************************************************************* //
    protected $fillable = [
        'id', 'user_id', 'brand_id', 'serial', 'model', 'description', 'image', 'location', 'cost', 'status'
    ];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
    protected $casts = [
        'id'          => 'integer',
        'user_id'     => 'integer',
        'brand_id'    => 'integer',
        'serial'      => 'string',
        'model'       => 'string',
        'description' => 'string',
        'image'       => 'string',
        'location'    => 'string',
        'observation' => 'string',
        'cost'        => 'double',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];
    // ********************************************************************* //
    // * RELATIONSHIP                                                      * //
    // ********************************************************************* //
    // * Printer -> 1:N -> Follow
    public function follows(): HasMany
    {
        return $this->hasMany(Follow::class);
    }
    // * Printer -> 1:N -> Archive
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
    // * Printer -> 1:1 -> Brand
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    // * Printer -> 1:1 -> User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
