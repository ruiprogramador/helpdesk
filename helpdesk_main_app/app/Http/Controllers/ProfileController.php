<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
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
    public function update(Request $request, Profile $profile)
    {
        dd('Update');
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
        dd('Password');
    }
}
