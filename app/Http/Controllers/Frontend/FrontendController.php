<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\ClassifiedAds;
use App\Models\Comment;
use App\Models\News;
use App\Models\NewsView;
use App\Models\SubCategory;
use App\Models\Video;
use Illuminate\Http\Request;

class FrontendController
{
    public function index()
    {
        $categories = Category::with('subCategories')->where('status', '1')->get();
        $allbreakingNews = News::with('comments')->where([['status', 'active'], ['is_breaking_news', '1']])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $homeActiveCategory = Category::with('topNews')->where([['status', '1'], ['show_on_home', '1']])->get();
        // dd($homeActiveCategory->toArray());
        $alllatestNews = News::with('comments')->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $allHighlights = News::with('comments')->where([['status', 'active'], ['is_highlight', '1']])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $videos = Video::where('status', '1')->get();
        return view('frontend.pages.home', compact('categories', 'allbreakingNews', 'homeActiveCategory', 'alllatestNews', 'allHighlights', 'videos'));
    }

    public function categoryIndex($catSlug = null, $subCatSlug = null)
    {
        $page_category = Category::with('subCategories')->where([['status', '1'], ['slug', $catSlug]])->first();
        $sub_category = SubCategory::where([['status', '1'], ['slug', $subCatSlug]])->first();
        $newslist = News::where([['status', 'active'], ['category_id', $page_category->id]])
            ->when($sub_category, function ($query) use ($sub_category) {
                return $query->where('sub_category_id', $sub_category->id);
            })
            ->paginate(10);
        return view('frontend.pages.category', compact('page_category', 'sub_category', 'newslist'));
    }

    public function newsDetail($slug)
    {
        $news = News::with('comments')->where('slug', $slug)->firstOrFail();
        $recent_news = News::where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        recordView('news', $news->id);
        return view('frontend.pages.news-detail', compact('news', 'recent_news'));
    }

    public function commentStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'comment' => 'required|string',
        ]);

        Comment::create([
            'news_id' => $request->news_id ?? null, // optional if linking to news
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Comment saved']);
    }

    public function videoList()
    {
        $videos = Video::where('status', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('frontend.pages.videos', compact('videos'));
    }
    public function videoDetail($slug)
    {
        $video = Video::where('slug', $slug)->firstOrFail();
        $recent_videos = Video::where('status', '1')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        recordView('video', $video->id);
        return view('frontend.pages.video-detail', compact('video', 'recent_videos'));
    }

    public function privacyPolicy()
    {
        return view('frontend.pages.privacy-policy');
    }
    public function termsConditions()
    {
        return view('frontend.pages.terms-condition');
    }

    public function search($param, $page = 1)
    {
        $search_results = News::where('status', 'active')
            ->where(function ($query) use ($param) {
                $query->where('title', 'like', '%' . $param . '%')
                    ->orWhere('description', 'like', '%' . $param . '%');
            })
            ->paginate(10, ['*'], 'page', $page);
        return view('frontend.pages.search-results', compact('search_results', 'param'));
    }

    public function contactUs()
    {
        return view('frontend.pages.contact-us');
    }

    public function classifiedAds()
    {
        $ads = ClassifiedAds::where('status', 'active')->get();
        return view('frontend.pages.classified-ads', compact('ads'));
    }

    public function liveTv(){
        $video = [];
        return view('frontend.pages.live-tv', compact('video'));
    }
}
