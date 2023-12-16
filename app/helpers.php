<?php

use Illuminate\Contracts\Auth\Authenticatable;

// If the function doesn't exist, let's create it!
if ( ! function_exists('user')) {
    /**
     * Returns the current user. Shorthand for
     * auth()->user()
     *
     * @return Authenticatable|null
     */
    function user(): ?Authenticatable
    {
        return auth()->user();
    }
}
