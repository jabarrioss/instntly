<?php

namespace App\Observers;

use App\Models\Mint;
use App\Models\User;
use App\Models\Merchant;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        if($mint = Mint::where('label', $user->name)->first()){
            $mint->integration_id = $user->id;
            $user->merchant_id = $mint->merchant_id;
            $mint->save();
        }else{
            $user->merchant_id = 0;
        }
        $user->save();
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $merchant = Merchant::find($user->merchant_id);
        $merchant->delete();
        $mint = Mint::where(['merchant_id' => $user->merchant_id, 'integration_id' => $user->id])->first();
        $mint->delete();
        $user->merchant_id = 0;
        $user->save();
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        if($mint = Mint::where('label', $user->name)->first()){
            $mint->integration_id = $user->id;
            $user->merchant_id = $mint->merchant_id;
            $mint->save();
        }else{
            $user->merchant_id = 0;
        }
        $user->save();
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
