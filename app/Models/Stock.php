<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;
    // ********************************************************************* //
    // * TABLE                                                             * //
    // ********************************************************************* //
    protected $table = "stock";
    protected $primaryKey = 'id';
    public $incrementing  = true;
    protected $keyType    = true;
    // ********************************************************************* //
    // * ATTRIBUTES                                                        * //
    // ********************************************************************* //
    protected $fillable = [
        'id', 'user_id', 'cartridge_id',
        'quantity', '_quantity', 'cost',
        'type', 'observation', 'status',
        'created_at', 'date_at',
    ];
    protected $hidden = [
        'updated_at', 'deleted_at',
    ];
    protected $casts = [
        'id'           => 'integer',
        'user_id'      => 'integer',
        'cartridge_id' => 'integer',
        'quantity'     => 'double',
        '_quantity'    => 'double',
        'type'         => 'integer',
        'observation'  => 'string',
        'cost'         => 'double',
        'status'       => 'string',
        'date_at'      => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];
    // ********************************************************************* //
    // * RELATIONSHIP                                                      * //
    // ********************************************************************* //
    // * Stock -> 1:1 -> Cartridge
    public function cartridge(): BelongsTo
    {
        return $this->belongsTo(Cartridge::class);
    }
    // * Stock -> 1:1 -> User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
