<?php

namespace App\Helpers;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

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

    public static function convertToRouteName($string)
    {
        return strtolower(str_replace(' ', '.', $string));
    }

    public static function convertToParameterRouteName($string)
    {
        return strtolower(str_replace(' ', '_', $string));
    }

    public static function displayErrorsMessage($errors){
        alert()->error('Error')
            ->html('<i class="fas fa-2x fa-exclamation-triangle" style="color: #d33;"></i> ' . $errors)
            ->showConfirmButton('OK', '#3085d6');

        return redirect()->back();
    }
}
