<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // ********************************************************************* //
    // * TABLE                                                             * //
    // ********************************************************************* //
    protected $table = "users";
    protected $primaryKey = 'id';
    public $incrementing  = true;
    protected $keyType    = true;
    // ********************************************************************* //
    // * ATTRIBUTES                                                        * //
    // ********************************************************************* //
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'id'                => 'integer',
        'name'              => 'string',
        'email'             => 'string',
        'password'          => 'string',
        'status'            => 'string',
        'email_verified_at' => 'datetime',
        'remember_token'    => 'string',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
    ];
    // ********************************************************************* //
    // * RELATIONSHIP                                                      * //
    // ********************************************************************* //
    // * User -> 1:N -> Archive
    public function archives(): HasMany
    {
        return $this->hasMany(Archive::class);
    }
    // * User -> 1:N -> Brand
    public function brands(): HasMany
    {
        return $this->hasMany(Brand::class);
    }
    // * User -> 1:N -> Cartridge
    public function cartridge(): HasMany
    {
        return $this->hasMany(Cartridge::class);
    }
    // * User -> 1:N -> File
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
    // * User -> 1:N -> Follow
    public function follows(): HasMany
    {
        return $this->hasMany(Follow::class);
    }
    // * User -> 1:N -> Maintenance
    public function maintenance(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }
    // * User -> 1:N -> Printer
    public function printers(): HasMany
    {
        return $this->hasMany(Printer::class);
    }
    // * User -> 1:N -> Stock
    public function stock(): HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
