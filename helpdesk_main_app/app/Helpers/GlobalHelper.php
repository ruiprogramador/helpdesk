<?php

namespace App\Helpers;

class GlobalHelper
{
    // Example of a static helper method
    public static function greet($name)
    {
        return "Hello, " . $name;
    }

    // Example of another static method
    public static function formatCurrency($amount)
    {
        return "$" . number_format($amount, 2);
    }

    // Example of a static method that clears the session
    public static function clearSession()
    {
        session()->forget('alert');
    }

    public static function capitalize($string)
    {
        return ucwords($string);
    }
}
