<?php

namespace App\Rules;

use App\Models\Log;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class AwbRules implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $awb = Log::where('created_at','<',date('Y-m-d'))->where('awb',$value)->first();
        if ($awb == null) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'AWB sudah pernah discan';
    }
}
