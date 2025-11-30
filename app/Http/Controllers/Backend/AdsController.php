<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController
{
    public function index(Request $request)
    {
        $ads = Ads::paginate(10);
        return view('backend.pages.ads-list', compact('ads'));
    }
    public function addAdsIndex($id = null)
    {
        $ads = [];
        if ($id) {
            $ads = Ads::find($id);
        }
        return view('backend.pages.ads-add', compact('ads'));
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'title'            => 'nullable|string|max:255',
            'link'             => 'nullable|url',
            'position'         => 'required|string',
            'status'           => 'required|in:active,inactive',
            'images.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // find or create
        $ads = Ads::find($request->ads_id) ?? new Ads();
        $ads->fill($request->only(['title', 'link', 'position', 'status']));

        // old images
        $existing = $ads->images ? json_decode($ads->images, true) : [];
        $newImages = [];

        // upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $newImages[] = $this->uploadAdsImage($file);
            }
        }

        // merge old + new images
        $ads->images = json_encode(array_merge($existing, $newImages));

        $ads->save();

        return response()->json([
            "success"  => true,
            "message" => $request->ads_id ? "Ads updated successfully!" : "Ads added successfully!",
        ]);
    }

    private function uploadAdsImage($file)
    {
        $folder = "uploads/ads/";
        $filename = time() . '-' . uniqid() . '.' . $file->extension();

        $file->move(public_path($folder), $filename);

        return $folder . $filename;
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'ads_id' => 'required|integer',
            'image'  => 'required|string'
        ]);

        $ads = Ads::findOrFail($request->ads_id);
        $images = json_decode($ads->images, true);

        // remove clicked image
        $filtered = array_filter($images, fn($img) => $img !== $request->image);

        // delete from server
        if (file_exists(public_path($request->image))) {
            @unlink(public_path($request->image));
        }

        // save updated images
        $ads->images = json_encode(array_values($filtered));
        $ads->save();

        return response()->json([
            "success" => true,
            "message" => "Image deleted successfully!"
        ]);
    }
}
