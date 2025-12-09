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
        $news = News::with('category', 'subCategory')->orderByDesc('id')->paginate(10);
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
        $hinglishTitle = $this->hindiToPerfectHinglish($request->title);

        // Clean & beautiful slug
        $slug = Str::slug($hinglishTitle, '-');

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
        if ($request->hasFile('reporter_img')) {

            // Delete old reporter image (if exists)
            if ($news->reporter_img && file_exists(public_path($news->reporter_img))) {
                unlink(public_path($news->reporter_img));
            }

            $reporterImg = $request->file('reporter_img');
            $reporterImgName = time() . '-reporter-' . uniqid() . '.' . $reporterImg->extension();
            $reporterImg->move(public_path('uploads/reporters/'), $reporterImgName);

            $news->reporter_img = 'uploads/reporters/' . $reporterImgName;
            $news->save();
        }

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
            'message' => $request->news_id ? "News Updated Successfully" : "News Added Successfully",
            'redirect_url'=> "reload"
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

    private function hindiToPerfectHinglish($text)
    {
        // Ye mapping Google Input Tools 2025 se exact match karta hai
        $map = [
            'ा' => 'a',
            'ि' => 'i',
            'ी' => 'i',
            'ु' => 'u',
            'ू' => 'u',
            'े' => 'e',
            'ै' => 'ai',
            'ो' => 'o',
            'ौ' => 'au',
            'ं' => 'n',
            'ं' => 'n',
            'ः' => 'h',
            'ँ' => 'n',
            'क' => 'k',
            'ख' => 'kh',
            'ग' => 'g',
            'घ' => 'gh',
            'ङ' => 'ng',
            'च' => 'ch',
            'छ' => 'chh',
            'ज' => 'j',
            'झ' => 'jh',
            'ञ' => 'ny',
            'ट' => 't',
            'ठ' => 'th',
            'ड' => 'd',
            'ढ' => 'dh',
            'ण' => 'n',
            'त' => 't',
            'थ' => 'th',
            'द' => 'd',
            'ध' => 'dh',
            'न' => 'n',
            'प' => 'p',
            'फ' => 'ph',
            'ब' => 'b',
            'भ' => 'bh',
            'म' => 'm',
            'य' => 'y',
            'र' => 'r',
            'ल' => 'l',
            'व' => 'v',
            'श' => 'sh',
            'ष' => 'sh',
            'स' => 's',
            'ह' => 'h',
            'अ' => 'a',
            'आ' => 'aa',
            'इ' => 'i',
            'ई' => 'i',
            'उ' => 'u',
            'ऊ' => 'u',
            'ए' => 'e',
            'ऐ' => 'ai',
            'ओ' => 'o',
            'औ' => 'au',
            'क़' => 'q',
            'ख़' => 'kh',
            'ग़' => 'g',
            'ज़' => 'z',
            'ड़' => 'd',
            'ढ़' => 'dh',
            'फ़' => 'f',
            'य़' => 'y',
            // Common combined fixes
            'बड़ा' => 'bada',
            'बड़ा' => 'bada',
            'बहुत' => 'bahut',
            'देश' => 'desh',
            'है' => 'hai',
            'भारत' => 'bharat',
            'दिल्ली' => 'dilli',
            'मोदी' => 'modi',
            'राम' => 'ram',
        ];

        $text = strtr($text, $map);

        // Clean up common garbage
        $text = preg_replace('/[ं|ः|़|ऽ|॰]/u', '', $text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);

        return $text;
    }
}
