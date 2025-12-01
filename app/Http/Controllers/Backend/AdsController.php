<?php

namespace App\Http\Controllers\Backend;

use App\Models\Ads;
use App\Models\ClassifiedAds;
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

    public function deleteAds(request $request)
    {
        $ads = Ads::findOrFail($request->id);

        // delete images from server
        $images = $ads->images ? json_decode($ads->images, true) : [];
        foreach ($images as $img) {
            if (file_exists(public_path($img))) {
                @unlink(public_path($img));
            }
        }

        $ads->delete();

        return response()->json([
            "success" => true,
            "message" => "Ads deleted successfully!"
        ]);
    }


    public function ClassifiedIndex(Request $request)
    {
        $ads = ClassifiedAds::paginate(10);
        return view('backend.pages.classified-ads-list', compact('ads'));
    }
    public function addClassifiedAdsIndex($id = null)
    {
        $ads = [];
        if ($id) {
            $ads = ClassifiedAds::find($id);
        }
        return view('backend.pages.classified-ads-add', compact('ads'));
    }

    public function ClassifiedstoreOrUpdate(Request $request)
    {
        $request->validate([
            'title'            => 'nullable|string|max:255',
            'link'             => 'nullable|url',
            'status'           => 'required|in:active,inactive',
            'images.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // find or create
        $ads = ClassifiedAds::find($request->ads_id) ?? new ClassifiedAds();
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
    public function deleteClassifiedImage(Request $request)
    {
        $request->validate([
            'ads_id' => 'required|integer',
            'image'  => 'required|string'
        ]);

        $ads = ClassifiedAds::findOrFail($request->ads_id);
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

    public function deleteClassifiedAds(request $request)
    {
        $ads = ClassifiedAds::findOrFail($request->id);

        // delete images from server
        $images = $ads->images ? json_decode($ads->images, true) : [];
        foreach ($images as $img) {
            if (file_exists(public_path($img))) {
                @unlink(public_path($img));
            }
        }

        $ads->delete();

        return response()->json([
            "success" => true,
            "message" => "Classified Ads deleted successfully!"
        ]);
    }
}
