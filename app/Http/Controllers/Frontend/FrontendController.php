<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class FrontendController
{
    public function index()
    {
        $categories = Category::with('subCategories')->where('status', '1')->get();
        return view('frontend.pages.home', compact('categories'));
    }

    public function categoryIndex($catSlug = null, $subCatSlug = null)
    {
        $page_category = Category::with('subCategories')->where([['status', '1'], ['slug', $catSlug]])->first();
        $sub_category = SubCategory::where([['status', '1'], ['slug', $subCatSlug]])->first();
        return view('frontend.pages.category', compact('page_category', 'sub_category'));
    }
}
