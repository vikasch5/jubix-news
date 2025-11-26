<?php

namespace App\Http\Controllers\Backend;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VideoController
{
    public function index()
    {
        $videos = Video::paginate(10);
        return view("backend.pages.video-list", compact('videos'));
    }

    public function videoAddIndex($id = null)
    {
        $video = [];
        if ($id) {
            $video = Video::find($id);
        }
        return view("backend.pages.video-add", compact('video'));
    }
    public function storeOrUpdate(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|max:255',
            'youtube_link' => 'required|string',
            'description'  => 'nullable|string',
            'meta_title'   => 'nullable|string|max:255',
            'meta_details' => 'nullable|string',
            'meta_keyword' => 'nullable|string',
            'slug'         => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation Error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Generate slug if not provided
        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        // Ensure unique slug
        $originalSlug = $slug;
        $count = 1;

        while (Video::where('slug', $slug)
            ->where('id', '!=', $request->video_id)
            ->exists()
        ) {
            $slug = $originalSlug . '-' . $count++;
        }

        // Insert or Update
        $video = Video::updateOrCreate(
            ['id' => $request->video_id],
            [
                'title'        => $request->title,
                'slug'         => $slug,
                'youtube_link' => $request->youtube_link,
                'description'  => $request->description,
                'meta_title'   => $request->meta_title,
                'meta_details' => $request->meta_details,
                'meta_keyword' => $request->meta_keyword,
                'status'       => $request->status,
            ]
        );

        return response()->json([
            'success'   => true,
            'message'  => $request->video_id ? "Video Updated Successfully" : "Video Added Successfully",
            'redirect' => route('admin.video.list'),
        ]);
    }


    public function delete(Request $request)
    {
        $video = Video::find($request->id);
        if ($video) {
            $video->delete();
            return response()->json([
                'success' => true,
                'message' => 'Video Deleted Successfully',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Video Not Found',
            ], 404);
        }
    }
}
