<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class AssetController extends Controller
{

    public function index()
    {
        $title = "Kelola Aset Toko";
        $assets = Asset::all();
        return view('admin.assets.index', compact('assets', 'title'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240|nullable',  
                'mainBanner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240|nullable',  
                'womanBanner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240|nullable',  
                'menBanner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240|nullable',  
                'kidsBanner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240|nullable',  
                'otherBanner' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240|nullable',  
            ], [
                '*.mimes' => 'Unsupported file format. Please upload an image in JPEG, PNG, JPG, GIF, or SVG format.',
                '*.max' => 'File too large. Maximum file size allowed is 10MB.'
            ]);

            foreach (['logo', 'mainBanner', 'womanBanner', 'menBanner', 'kidsBanner', 'otherBanner'] as $type) {
                if ($request->hasFile($type)) {
                    $file = $request->file($type);
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $destinationPath = public_path('images/banner');
                    $file->move($destinationPath, $filename);
                    $path = "images/banner/" . $filename;
                    Log::info('Asset uploaded: ' . $path);
                    Asset::updateOrCreate(
                        ['type' => $type],
                        ['path' => $path]
                    );
                } else {
                    Log::info('No asset uploaded for ' . $type);
                }
            }

            Alert::success('Success', 'Assets uploaded successfully.');
            return redirect()->back();
        } catch (ValidationException $e) {
            Log::error('Validation failed: ' . $e->getMessage());
            $errors = $e->errors();
            foreach ($errors as $field => $message) {
                Alert::error('Validation Error', $message[0]);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Failed to upload asset: ' . $e->getMessage());
            Alert::error('Error', 'Failed to upload asset: ' . $e->getMessage());
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        try {
            $asset = Asset::findOrFail($id);
            return view('admin.edit', compact('asset'));
        } catch (\Exception $e) {
            Log::error('Failed to find asset: ' . $e->getMessage());
            Alert::error('Error', 'Failed to find the asset.');
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $asset = Asset::findOrFail($id);
            $request->validate([
                'path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($request->hasFile('path')) {
                // Delete old file if exists
                $oldFile = public_path($asset->path);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }

                // Upload new file
                $filename = time() . '.' . $request->file('path')->getClientOriginalExtension();
                $destinationPath = public_path('images/banner');
                $request->file('path')->move($destinationPath, $filename);
                $asset->path = "images/banner/" . $filename;
                $asset->save();
            }

            Alert::success('Success', 'Asset updated successfully.');
            return redirect()->route('assets.index');
        } catch (ValidationException $e) {
            Log::error('Validation failed: ' . $e->getMessage());
            $errors = $e->errors();
            foreach ($errors as $field => $message) {
                Alert::error('Validation Error', $message[0]);
            }
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Failed to update asset: ' . $e->getMessage());
            Alert::error('Error', 'Failed to update asset.');
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $asset = Asset::findOrFail($id);

            // Delete the file from storage
            $file = public_path($asset->path);
            if (file_exists($file)) {
                unlink($file);
            }

            // Delete the asset from the database
            $asset->delete();

            Alert::success('Success', 'Asset deleted successfully.');
            return back();
        } catch (\Exception $e) {
            Log::error('Failed to delete asset: ' . $e->getMessage());
            Alert::error('Error', 'Failed to delete asset.');
            return back();
        }
    }

    public function getLogoPath()
    {
        $logo = Asset::where('type', 'logo')->first();
        return $logo ? $logo->path : 'assets/images/default-logo.png';
    }

    public function getMainBannerPath()
    {
        $mainBanner = Asset::where('type', 'mainBanner')->first();
        return $mainBanner ? $mainBanner->path : 'assets/images/default-banner.jpg';
    }

    public function getBannerPath($type)
    {
        $banner = Asset::where('type', $type)->first();
        if (!$banner) {
            Log::warning("Banner type '{$type}' not found.");
            return 'assets/images/default-banner.jpg';
        }
        return $banner->path;
    }
  

}
