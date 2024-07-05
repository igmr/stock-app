<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use HasFactory, SoftDeletes;
    // ********************************************************************* //
    // * TABLE                                                             * //
    // ********************************************************************* //
    protected $table = "files";
    protected $primaryKey = 'id';
    public $incrementing  = true;
    protected $keyType    = true;
    // ********************************************************************* //
    // * ATTRIBUTES                                                        * //
    // ********************************************************************* //
    protected $fillable = [
        'id', 'user_id', 'printer_id', 'title', 'filename', 'observation', 'status'
    ];
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at',
    ];
    protected $casts = [
        'id'          => 'integer',
        'user_id'     => 'integer',
        'printer_id'  => 'integer',
        'title'       => 'string',
        'filename'    => 'string',
        'observation' => 'string',
        'status'      => 'string',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];
    // ********************************************************************* //
    // * RELATIONSHIP                                                      * //
    // ********************************************************************* //
    // * File -> 1:1 -> Printer
    public function printer(): BelongsTo
    {
        return $this->belongsTo(Printer::class);
    }
    // * File -> 1:1 -> User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
