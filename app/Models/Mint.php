<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

/**
 * Class that defines the relationship between 
 * the Merchant model and the User (integrations) model
 * 
 * Created date: 20/09/2021
 * Modified date: 20/09/2021
 *
 * Developed by: Jhonny B. Sandrea for Kleverpay
 */

class Mint extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    /**
     * Get the merchant that owns the Mint
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    /**
     * Get all of the integrations for the Mint
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function integrations(): BelongsTo
    {
        return $this->belongsTo(User::class, 'integration_id');
    }
}
