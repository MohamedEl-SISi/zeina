<?php

namespace App\Http\Controllers;

use ZeinaDev\Services\Interfaces\WebsiteInterface;
use Illuminate\Http\Request;
use App\Http\Helpers\Helpers;
use App\OrderOfItems;
use Mail;

class WebsiteController extends Controller
{
  private $website;

    public function __construct(WebsiteInterface $webService)
    {
        $this->website = $webService;
    }
    public function Home()
    {
      $data = Helpers::cacheRemember("HomePage",1, function ()  {
                  return  $this->website->HomeData();
                  });
      return view('website.pages.home',compact('data'));
    }

    public function NewsSection(Request $request)
    {
      if(isset($request->slug))
      {
        $data = Helpers::cacheRemember($request->slug."_news_Section_page",1, function () use($request)  {
                    return  $this->website->newsSection($request->slug);
                    });
        if(is_null($data)) return redirect('404');
          return view('website.pages.newsSection',compact('data'));
      }else
      {
        return redirect('404');
      }

    }

    public function NewsSectionApi(Request $request)
    {
      if(isset($request->slug))
      {
        $data = Helpers::cacheRemember($request->page."_".$request->slug."_news_Section_api",1, function () use($request)  {
                    return  $this->website->newsSectionapi($request->slug);
                    });

        if(is_null($data)) return  Helpers::apiResponse(null,0,"no section with this Slug",200);

          return Helpers::apiResponse($data,1,"loadmore News Section",200);

      }else
      {
        return Helpers::apiResponse(null,0,"no Slug send",200);
      }
    }

    public function NewsSingle(Request $request)
    {
      if(isset($request->slug) && isset($request->id) )
      {
        $item = Helpers::cacheRemember($request->slug."_".$request->id."_news_single",2, function () use($request)  {
                    return  $this->website->newsSingle($request->id,$request->slug);
                    });
        if(is_null($item)) return redirect('404');

          return view('website.pages.newsSingle',compact('item'));
      }else
      {
        return redirect('404');
      }
    }

    public function Articles()
    {
        $data = Helpers::cacheRemember("ArticlesSection",1, function ()  {
                    return  $this->website->articles();
                    });
        if(is_null($data)) return redirect('404');
        return view('website.pages.ArticlesSection',compact('data'));
    }

    public function ArticlesSection(Request $request)
    {
        if(isset($request->slug))
        {
          $data = Helpers::cacheRemember($request->slug."_articles_section",1, function () use($request)  {
                      return  $this->website->articlesSection($request->slug);
                      });
          if(is_null($data)) return redirect('404');
          // dd($data);
            return view('website.pages.ArticlesSubSection',compact('data'));
        }else
        {
          return redirect('404');
        }

    }

      public  function ArticlesSectionApi(Request $request)
      {
        if(isset($request->slug))
        {
          $data = Helpers::cacheRemember($request->page.'_'.$request->slug."_ArticlesSectionApi",1, function () use($request)  {
                      return  $this->website->articleSectionapi($request->slug);
                      });
          if(is_null($data)) return  Helpers::apiResponse(null,0,"no section with this Slug",200);

            return Helpers::apiResponse($data,1,"loadmore News Section",200);
        }else
        {
          return Helpers::apiResponse(null,0,"no Slug send",200);
        }
      }

      public function ArticlesSingle(Request $request)
      {
        if(isset($request->slug) && isset($request->id) )
        {
          $item = Helpers::cacheRemember($request->slug."_".$request->id."_artcle_single",2, function () use($request)  {
                      return  $this->website->articleSingle($request->id,$request->slug);
                      });

          if(is_null($item)) return redirect('404');
            return view('website.pages.articlesSingle',compact('item'));

        }else
        {
          return redirect('404');
        }
      }

      public function filesSection()
      {
        $data = Helpers::cacheRemember("files",1, function ()   {
                    return  $this->website->files();
                    });
        return view('website.pages.filesSection',compact('data'));

      }
      public function filesApi(Request $request)
      {
        $data = Helpers::cacheRemember($request->page."_files",1, function () use($request)  {
                    return  $this->website->filesApi();
                    });
          return Helpers::apiResponse($data,1,"loadmore quiz Section",200);
        }


      public function filesSingle(Request $request)
      {
        if(isset($request->slug) && isset($request->id) )
        {
          $data = Helpers::cacheRemember($request->slug."_".$request->id."_file_single",2, function () use($request)  {
                      return  $this->website->fileSingle($request->id,$request->slug);
                      });
          if(is_null($data)) return redirect('404');
            return view('website.pages.filesSingle',compact('data'));
        }else
        {
          return redirect('404');
        }
      }

      public function tags(Request $request)
      {
        if(isset($request->slug))
        {
          $data = Helpers::cacheRemember($request->slug."_tags",1, function () use($request)  {
                      return  $this->website->newstags($request->slug);
                      });
          if(is_null($data)) return redirect('404');
            return view('website.pages.tagsNewsSection',compact('data'));

        }else
        {
          return redirect('404');
        }
      }

      public function TagsSectionApi(Request $request)
      {
        if(isset($request->slug))
        {
          $data = Helpers::cacheRemember($request->page."_".$request->slug."_tags_api",1, function () use($request)  {
                      return  $this->website->newstagsapi($request->slug);
                      });

          if(is_null($data)) return  Helpers::apiResponse(null,0,"no tag with this Slug",200);

            return Helpers::apiResponse($data,1,"loadmore tags",200);

        }else
        {
          return Helpers::apiResponse(null,0,"no Slug send",200);
        }
      }

      public function search(Request $request)
      {
          if(isset($request->q))
        {
          $data = Helpers::cacheRemember($request->q."_search",10, function () use($request)  {
                      return  $this->website->search($request->q);
                      });
          if(is_null($data)) return redirect('404');
            return view('website.pages.tagsNewsSection',compact('data'));
        }else
        {
          return redirect('404');
        }

      }

      public function SearchSectionApi(Request $request)
      {
        if(isset($request->q))
        {
          $data = Helpers::cacheRemember($request->page."_".$request->q."_search_api",1, function () use($request)  {
                      return  $this->website->searchapi($request->q);
                      });

          if(is_null($data)) return  Helpers::apiResponse(null,0,"no news with this keyword",200);

            return Helpers::apiResponse($data,1,"loadmore Search",200);

        }else
        {
          return Helpers::apiResponse(null,0,"no keyword send",200);
        }
      }

      public function exams(Request $request)
      {
        $data = Helpers::cacheRemember("exam",1, function () use($request)  {
                    return  $this->website->exam();
                    });
        return view('website.pages.quizSection',compact('data'));

      }
      public function examsSection(Request $request)
      {

        if(isset($request->slug))
        {
          $data = Helpers::cacheRemember($request->slug."_exam",1, function () use($request)  {
                      return  $this->website->examSection($request->slug);
                      });
          if(is_null($data)) return redirect('404');

          return view('website.pages.quizSectionSub',compact('data'));
        }else
        {
          return redirect('404');
        }
      }


      public function examsApi(Request $request)
      {

        $data = Helpers::cacheRemember($request->slug.'_'.$request->page."_exam_api",1, function () use($request)  {
                    return  $this->website->examApi($request->slug??null);
                    });

          return Helpers::apiResponse($data,1,"loadmore quiz Section",200);
      }

      public function examsSingle(Request $request)
      {
        if(isset($request->slug) && isset($request->id) )
        {
          $item = /* Helpers::cacheRemember($request->slug."_".$request->id."_exam_single",2, function () use($request)  {
                      return */  $this->website->examSingle($request->id,$request->slug);
                      // });
          if(is_null($item)) return redirect('404');
          // dd($item);
            return view('website.pages.quizSingle',compact('item'));
        }else
        {
          return redirect('404');
        }
      }

      public function aboutUs()
      {
        return view('website.pages.aboutUs');
      }
      public function privacy()
      {
        return view('website.pages.privacy');
      }
      public function share_with_us()
      {
        return view('website.pages.share_with_us');
      }
      public function contactUs()
      {
        $socailLinks = Helpers::cacheRemember("socailMedia",1, function ()  {
                    return  OrderOfItems::select('data')->where('type','socailMedia')->first();
                    });
        $socailLinks = isset($socailLinks)?$socailLinks->data:null;
        return view('website.pages.contactUs',compact('socailLinks'));
      }

      public function ContactusForm(Request $request)
      {
        $model =array(
          'name'=>$request->name,
          'email'=> $request->email,
          'number' =>$request->number,
          'subject' =>$request->subject,
          'body'=>strip_tags($request->body)
      );

    if(!empty($request->email) )
    {
      try{
        Mail::send('contactMsg', $model, function($message)
          {
            $message->to('zeinaforher@gmail.com');
            $message->subject('Website Contact Us Form');
          });
      }
      catch(\Exception $ex){
        return redirect()->back()->with('ContactFormError', '1');
          }
      return redirect()->back()->with('ContactForm', '1');
    }else
    {
        return redirect()->back()->with('ContactFormError', '1');
    }
      }
}
