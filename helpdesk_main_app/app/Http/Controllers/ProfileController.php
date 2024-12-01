<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Helpers\GlobalHelper;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function __construct()
    {
        $globalHelper = new GlobalHelper();

        $globalHelper->clearSession();
    }

    private function displayErrorsMessage($errors){
        alert()->error('Error')
            ->html('<i class="fas fa-2x fa-exclamation-triangle" style="color: #d33;"></i> ' . $errors)
            ->showConfirmButton('OK', '#3085d6');

        return redirect()->back();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profile.edit');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        dd('Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        dd('Store');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {


        dd($profile);
        dd('Show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {


        dd('Edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {


        $profileRequest = new ProfileRequest();

        if(
            1 == 1
            && $profileRequest->authorize()
        ){
            // return redirect()->route('profile.edit')->with('error', 'You are not authorized to update this profile.');
            Alert::error('Error', 'User not authenticated.');

            return redirect()->back();
        }

        $profile = Profile::find($request->id);

        /**
         * If user is not allowed to update the profile, redirect back with an error message.
         */
        if (
            1 == 1
            && $profile->id != auth()->user()->id
        ) {
            // return redirect()->route('profile.edit')->with('error', 'You are not authorized to update this profile.');
            Alert::error('Error', 'You are not authorized to update this profile.');

            return redirect()->back();
        }

        $validation = $profileRequest->validate($request->all());

        if(
            1 == 1
            && $validation->fails()
        ){
            // dd($validation->errors());

            /**
             * Check if email is already taken
             */
            if(
                1 == 1
                && $validation->errors()->has('email')
            ){
                // check if error message is 'The email has already been taken.'
                if(
                    1 == 1
                    && $validation->errors()->first('email') == 'The email is already taken'
                ){
                    /**
                     * Probably the user wanna update the profile with the same email.
                     */
                    if(
                        1 == 1
                        && $profile->email == $request->email
                    ){
                        // dd('Email taken but same as the current email');

                        /**
                         * Check if exists more than one error message.
                         */
                        if(
                            1 == 1
                            && count($validation->errors()->all()) > 1
                        ){

                            $errors_array = $validation->errors()->all();

                            $errors = '<ul>';

                            foreach($errors_array as $error){
                                $errors .= '<li>' . $error . '</li>';
                            }

                            $errors .= '</ul>';

                            return $this->displayErrorsMessage($errors);
                        }

                        $profile->update($request->all());

                        Alert::success('Success', 'Profile updated successfully!');

                        return redirect()->back();

                    }else{
                        $this->displayErrorsMessage('Email taken and different from the current email');
                    }
                }else{

                    // dd('Other 2 errors');

                    $errors_array = $validation->errors()->all();

                    $errors = '<ul>';

                    foreach($errors_array as $error){
                        $errors .= '<li>' . $error . '</li>';
                    }

                    $errors .= '</ul>';

                    return $this->displayErrorsMessage($errors);
                }
            }else{

                $errors_array = $validation->errors()->all();

                $errors = '<ul>';

                foreach($errors_array as $error){
                    $errors .= '<li>' . $error . '</li>';
                }

                $errors .= '</ul>';

                return $this->displayErrorsMessage($errors);
            }

        }

        $profile->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        dd('Destroy');
    }

    /**
     * Update the user's password.
     */
    public function password(Request $request, Profile $profile)
    {

        $profile = Profile::find($request->id);

        if(
            1 == 1
            && $profile->id != auth()->user()->id
        ){
            // return redirect()->route('profile.edit')->with('error', 'You are not authorized to update this profile.');
            Alert::error('Error', 'You are not authorized to update this profile.');

            return redirect()->back();
        }

        $passwordRequest = new PasswordRequest();

        $validation = $passwordRequest->validate($request->all());

        if(
            1 == 1
            && $validation->fails()
        ){
            // dd($validation->errors());

            $errors_array = $validation->errors()->all();

            $errors = '<ul>';

            foreach($errors_array as $error){
                $errors .= '<li>' . $error . '</li>';
            }

            $errors .= '</ul>';

            return $this->displayErrorsMessage($errors);
        }

        /**
         * Check if the password is the same as the current password.
         */
        if(
            1 == 1
            && Hash::check($request->password, $profile->password)
        ){
            return $this->displayErrorsMessage('The new password must be different from the current password.');
        }

        $profile->update([
            'password' => Hash::make($request->password)
        ]);

        Alert::success('Success', 'Password updated successfully!');

        return redirect()->back();
    }
}
