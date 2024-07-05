<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cartridge extends Model
{
    use HasFactory, SoftDeletes;
    // ********************************************************************* //
    // * TABLE                                                             * //
    // ********************************************************************* //
    protected $table = "cartridges";
    protected $primaryKey = 'id';
    public $incrementing  = true;
    protected $keyType    = true;
    // ********************************************************************* //
    // * ATTRIBUTES                                                        * //
    // ********************************************************************* //
    protected $fillable = [
        'id', 'user_id', 'brand_id', 'printer_id', 'model', 'image', 'description', 'color'
    ];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
    protected $casts = [
        'id'          => 'integer',
        'user_id'     => 'integer',
        'brand_id'    => 'integer',
        'printer_id'  => 'integer',
        'model'       => 'string',
        'image'       => 'string',
        'description' => 'string',
        'color'       => 'string',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];
    // ********************************************************************* //
    // * RELATIONSHIP                                                      * //
    // ********************************************************************* //
    // * Cartridge -> 1:N -> Stock
    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
    // * Cartridge -> 1:1 -> Brand
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    // * Cartridge -> 1:1 -> Printer
    public function printer(): BelongsTo
    {
        return $this->belongsTo(Printer::class);
    }
    // * Cartridge -> 1:1 -> User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
