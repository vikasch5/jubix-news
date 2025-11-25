<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Comment;
use App\Models\News;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController
{
    public function index()
    {
        $news = News::with('category', 'subCategory')->paginate(10);
        return view('backend.pages.news-list', compact('news'));
    }

    public function newsAddIndex($id = null)
    {
        $news = [];
        $subCategory = [];
        if ($id) {
            $news = News::find($id);
            $subCategory = SubCategory::where('category_id', $news->category_id)->get();
        }
        $all_categories = Category::where('status', '1')->get();
        return view('backend.pages.news-add', compact('news', 'all_categories', 'subCategory'));
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ]);
        $slug = Str::slug($request->title);;

        // Save basic data
        $news = News::updateOrCreate(
            ['id' => $request->news_id],
            [
                'title'             => $request->title,
                'reporter_name'     => $request->reporter_name,
                'category_id'       => $request->category_id,
                'sub_category_id'   => $request->sub_category_id,
                'slug'              => $slug,
                'status'            => $request->status,
                'show_on_home'      => $request->show_on_home ?? 0,
                'meta_title'        => $request->meta_title,
                'meta_description'  => $request->meta_description,
                'meta_keywords'     => $request->meta_keywords,
                'description'       => $request->description,
                'is_breaking_news'  => $request->is_breaking_news,
                'is_highlight'  => $request->is_highlight,

            ]
        );

        // -----------------------------------
        // Merge old + new images (IMPORTANT)
        // -----------------------------------
        $existingImages = $news->images ? json_decode($news->images, true) : [];
        $newImages = [];

        if ($request->hasFile('news_images')) {

            foreach ($request->file('news_images') as $img) {

                $fileName = time() . '-' . uniqid() . '.' . $img->extension();

                $img->move(public_path('uploads/news/'), $fileName);

                $newImages[] = 'uploads/news/' . $fileName;
            }
        }

        // Merge old + new
        $mergedImages = array_merge($existingImages, $newImages);

        // Save images only if changed
        if (!empty($newImages)) {
            $news->images = json_encode($mergedImages);
            $news->save();
        }

        return response()->json([
            'success' => true,
            'message' => $request->news_id ? "News Updated Successfully" : "News Added Successfully"
        ]);
    }


    public function deleteImage(Request $request)
    {
        $news = News::findOrFail($request->news_id);

        $images = json_decode($news->images, true);

        // Find image
        if (($key = array_search($request->image, $images)) !== false) {

            // Delete file from public folder
            $filePath = public_path($request->image);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Remove from array
            unset($images[$key]);
        }

        // Save updated list
        $news->images = array_values($images);
        $news->save();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);
    }

    public function deleteNews(Request $request)
    {
        $news = News::findOrFail($request->id);

        // Delete all images
        if (!empty($news->images)) {
            $images = is_array($news->images) ? $news->images : json_decode($news->images, true);

            foreach ($images as $img) {
                $filePath = public_path($img);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        // Delete database record
        $news->delete();

        return response()->json([
            'success' => true,
            'message' => "News deleted successfully"
        ]);
    }

    public function commentList()
    {
        $comments = Comment::with('news')->paginate('10');
        return view('admin.pages.comment-list', compact('comments'));
        
    }
}
