<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\ArticleSection;
use App\Images;
use App\News;
use App\Articles;
use App\Exams;
use App\OrderOfItems;

class DashboardController extends Controller
{
    public function index()
    {
        $sectionCount = Section::count();
        $sectionArticlesCount = ArticleSection::count();
        $imageCount = Images::count();
        $newsCount = News::count();
        $articlesCount = Articles::count();
        $examCount = Exams::count();
        $data = OrderOfItems::select('data')->where('type','socailMedia')->first();
        $data = isset($data)?$data->data:null;
      return view('dashboard.home',compact('sectionCount','sectionArticlesCount','imageCount','newsCount','articlesCount','examCount','data'));
    }
}
