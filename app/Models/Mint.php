<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Mint extends Model
{
    use HasFactory;

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
