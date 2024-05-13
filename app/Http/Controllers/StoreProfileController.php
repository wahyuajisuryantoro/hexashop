<?php

namespace App\Http\Controllers;

use App\Models\StoreProfile;

use Illuminate\Http\Request;

class StoreProfileController extends Controller
{
    public function index()
    {
        $title = 'Kelola Data Toko';
        $profile = StoreProfile::first();
        return view('admin.store.index', compact('profile', 'title'));
    }

    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'name_store' => 'required|string|max:255',
            'store_location' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'office_location' => 'required|string|max:255',
            'work_hours' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'map_url' => 'nullable|url',
        ]);


        $profile = new StoreProfile();
        $profile->name_store = $validatedData['name_store'];
        $profile->store_location = $validatedData['store_location'];
        $profile->phone = $validatedData['phone'];
        $profile->office_location = $validatedData['office_location'];
        $profile->work_hours = $validatedData['work_hours'];
        $profile->email = $validatedData['email'];
        $profile->instagram_url = $validatedData['instagram_url'] ?? null;
        $profile->facebook_url = $validatedData['facebook_url'] ?? null;
        $profile->twitter_url = $validatedData['twitter_url'] ?? null;
        $profile->map_url = $validatedData['map_url'] ?? null;



        $profile->save();

        return redirect()->back()->with('success', 'Profil toko berhasil disimpan.');
    }

    public function edit()
    {
        $profile = StoreProfile::first();
        if (!$profile) {
            return redirect()->back()->with('error', 'No profile found.');
        }
        return view('admin.store.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $profile = StoreProfile::first();
        if (!$profile) {
            return redirect()->back()->with('error', 'No profile to update.');
        }

        $validatedData = $request->validate([
            'name_store' => 'required|string|max:255',
            'store_location' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'office_location' => 'required|string|max:255',
            'work_hours' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'instagram_url' => 'nullable|url',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'map_url' => 'nullable|url',
        ]);

        $profile->update($validatedData);

        return redirect()->back()->with('success', 'Profil toko berhasil diperbarui.');
    }

    public function getDataProfile()
    {
        return StoreProfile::first();
    }
}
