<?php

namespace App\Models;

use App\Helpers\ShopifyOauth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Osiset\ShopifyApp\Contracts\ShopModel as IShopModel;
use Osiset\ShopifyApp\Traits\ShopModel;
use Exception;

class User extends Authenticatable implements IShopModel
{
    use HasApiTokens, HasFactory, Notifiable;
    use ShopModel, ShopifyOauth;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $encrypted_fields = [
        'password'
    ];

    public function isEncryptedField($key)
    {
        return in_array($key, $this->encrypted_fields);
    }

    public function decrypt($value)
    {
        try {
            return decrypt($value);
        } catch (Exception $e) {
            return;
        }
    }

    public function encrypt($key, $value)
    {
        $this->attributes[$key] = encrypt($value);
    }

    public function setAttribute($key, $value)
    {
        if ($this->isEncryptedField($key)) {
            return $this->encrypt($key, $value);
        }

        return parent::setAttribute($key, $value);
    }

    public function getAttributeValue($key)
    {
        $value = parent::getAttributeValue($key);
        if ($this->isEncryptedField($key)) {
            return $this->decrypt($value);
        }
        return $value;
    }

    /**
     * Get the merchant that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
}
