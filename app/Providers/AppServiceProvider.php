<?php

namespace App\Providers;

use ZeinaDev\Repository\Domain\RoleRepository;
use ZeinaDev\Repository\Domain\UsersRepository;
use ZeinaDev\Repository\Domain\ImagesRepository;
use ZeinaDev\Repository\Domain\SectionRepository;
use ZeinaDev\Repository\Domain\ArticlesSectionRepository;
use ZeinaDev\Repository\Domain\KeywordsRepository;
use ZeinaDev\Repository\Domain\NewsRepository;
use ZeinaDev\Repository\Domain\NewsKeywordsRepository;
use ZeinaDev\Repository\Domain\NewsRelatedRepository;
use ZeinaDev\Repository\Domain\FixedMediaRepository;
use ZeinaDev\Repository\Domain\ArticlesRepository;
use ZeinaDev\Repository\Domain\ArticlessKeywordsRepository;
use ZeinaDev\Repository\Domain\ArticlesRelatedRepository;
use ZeinaDev\Repository\Domain\QuestionRepository;
use ZeinaDev\Repository\Domain\ExamsRepository;
use ZeinaDev\Repository\Domain\ExamQuestionRepository;
use ZeinaDev\Repository\Domain\FilesRepository;
use ZeinaDev\Repository\Domain\FilesRelatedRepository;
use ZeinaDev\Repository\Domain\ExamsSectionRepository;

use ZeinaDev\Repository\Interfaces\RoleRepositoryInterface;
use ZeinaDev\Repository\Interfaces\UsersRepositoryInterface;
use ZeinaDev\Repository\Interfaces\ImagesRepositoryInterface;
use ZeinaDev\Repository\Interfaces\SectionRepositoryInterface;
use ZeinaDev\Repository\Interfaces\ArticlesSectionRepositoryInterface;
use ZeinaDev\Repository\Interfaces\KeywordsRepositoryInterface;
use ZeinaDev\Repository\Interfaces\NewsRepositoryInterface;
use ZeinaDev\Repository\Interfaces\NewsKeywordsRepositoryInterface;
use ZeinaDev\Repository\Interfaces\NewsRelatedRepositoryInterface;
use ZeinaDev\Repository\Interfaces\FixedMediaRepositoryInterface;
use ZeinaDev\Repository\Interfaces\ArticlesRepositoryInterface;
use ZeinaDev\Repository\Interfaces\ArticlesKeywordsRepositoryInterface;
use ZeinaDev\Repository\Interfaces\ArticlesRelatedRepositoryInterface;
use ZeinaDev\Repository\Interfaces\QuestionRepositoryInterface;
use ZeinaDev\Repository\Interfaces\ExamsRepositoryInterface;
use ZeinaDev\Repository\Interfaces\ExamQuestionRepositoryInterface;
use ZeinaDev\Repository\Interfaces\FilesRepositoryInterface;
use ZeinaDev\Repository\Interfaces\FilesRelatedRepositoryInterface;
use ZeinaDev\Repository\Interfaces\ExamsSectionRepositoryInterface;

use ZeinaDev\Services\Domain\RoleService;
use ZeinaDev\Services\Domain\UsersService;
use ZeinaDev\Services\Domain\ImagesService;
use ZeinaDev\Services\Domain\SectionService;
use ZeinaDev\Services\Domain\ArticlesSectionService;
use ZeinaDev\Services\Domain\KeywordsService;
use ZeinaDev\Services\Domain\NewsService;
use ZeinaDev\Services\Domain\FixedMediaService;
use ZeinaDev\Services\Domain\ArticlesService;
use ZeinaDev\Services\Domain\QuestionService;
use ZeinaDev\Services\Domain\ExamsService;
use ZeinaDev\Services\Domain\FilesService;
use ZeinaDev\Services\Domain\WebsiteService;
use ZeinaDev\Services\Domain\ExamsSectionService;

use ZeinaDev\Services\Interfaces\RoleServiceInterface;
use ZeinaDev\Services\Interfaces\UsersServiceInterface;
use ZeinaDev\Services\Interfaces\ImagesServiceInterface;
use ZeinaDev\Services\Interfaces\SectionServiceInterface;
use ZeinaDev\Services\Interfaces\ArticleSectionServiceInterface;
use ZeinaDev\Services\Interfaces\KeywordsServiceInterface;
use ZeinaDev\Services\Interfaces\NewsServiceInterface;
use ZeinaDev\Services\Interfaces\FixedMediaInterface;
use ZeinaDev\Services\Interfaces\ArticlesServiceInterface;
use ZeinaDev\Services\Interfaces\QuestionServiceInterface;
use ZeinaDev\Services\Interfaces\ExamsServiceInterface;
use ZeinaDev\Services\Interfaces\FilesServiceInterface;
use ZeinaDev\Services\Interfaces\WebsiteInterface;
use ZeinaDev\Services\Interfaces\ExamsSectionServiceInterface;

use App\Core\Repository\BaseRepository;
use App\Core\Repository\BaseRepositoryInterface;

use App\Core\Services\BaseService;
use App\Core\Services\BaseServiceInterface;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\View;
use App\Section;
use App\keywords;
use App\Articles;
use App\News;
use App\ArticleSection;
use App\OrderOfItems;
use App\Http\Helpers\Helpers;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);

      //repositories
      $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
      $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
      $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
      $this->app->bind(ImagesRepositoryInterface::class, ImagesRepository::class);
      $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
      $this->app->bind(KeywordsRepositoryInterface::class, KeywordsRepository::class);
      $this->app->bind(NewsRepositoryInterface::class, NewsRepository::class);
      $this->app->bind(NewsKeywordsRepositoryInterface::class, NewsKeywordsRepository::class);
      $this->app->bind(NewsRelatedRepositoryInterface::class, NewsRelatedRepository::class);
      $this->app->bind(FixedMediaRepositoryInterface::class, FixedMediaRepository::class);
      $this->app->bind(ArticlesSectionRepositoryInterface::class, ArticlesSectionRepository::class);
      $this->app->bind(ArticlesRepositoryInterface::class, ArticlesRepository::class);
      $this->app->bind(ArticlesKeywordsRepositoryInterface::class, ArticlessKeywordsRepository::class);
      $this->app->bind(ArticlesRelatedRepositoryInterface::class, ArticlesRelatedRepository::class);
      $this->app->bind(QuestionRepositoryInterface::class, QuestionRepository::class);
      $this->app->bind(ExamsRepositoryInterface::class, ExamsRepository::class);
      $this->app->bind(ExamQuestionRepositoryInterface::class, ExamQuestionRepository::class);
      $this->app->bind(FilesRepositoryInterface::class, FilesRepository::class);
      $this->app->bind(FilesRelatedRepositoryInterface::class, FilesRelatedRepository::class);
      $this->app->bind(ExamsSectionRepositoryInterface::class, ExamsSectionRepository::class);

      //domain
      $this->app->bind(BaseServiceInterface::class, BaseService::class);
      $this->app->bind(RoleServiceInterface::class, RoleService::class);
      $this->app->bind(UsersServiceInterface::class, UsersService::class);
      $this->app->bind(ImagesServiceInterface::class, ImagesService::class);
      $this->app->bind(SectionServiceInterface::class, SectionService::class);
      $this->app->bind(KeywordsServiceInterface::class, KeywordsService::class);
      $this->app->bind(NewsServiceInterface::class, NewsService::class);
      $this->app->bind(FixedMediaInterface::class, FixedMediaService::class);
      $this->app->bind(ArticleSectionServiceInterface::class, ArticlesSectionService::class);
      $this->app->bind(ArticlesServiceInterface::class, ArticlesService::class);
      $this->app->bind(QuestionServiceInterface::class, QuestionService::class);
      $this->app->bind(ExamsServiceInterface::class, ExamsService::class);
      $this->app->bind(FilesServiceInterface::class, FilesService::class);
      $this->app->bind(WebsiteInterface::class, WebsiteService::class);
      $this->app->bind(ExamsSectionServiceInterface::class, ExamsSectionService::class);

      define("IS_MOBILE", Helpers::IsMobile());

      View::composer(['website.layout.side_menu'],function($view) {

          $sectionMenu =  Helpers::cacheRemember("sectionMenu",5, function ()  {
                            return Section::select('name','slug','id')->where('in_menu',1)->whereNull('parentId')->where('status','published')->get();
                          });

          $orderMenuSection  = Helpers::cacheRemember("orderMenuSection",5, function ()  {
                                return  OrderOfItems::select('data')->where('type','SectionsOrderMenu')->first();
                                });
          $view->with('sectionMenu',$sectionMenu??[]);
          $view->with('orderMenuSection',$orderMenuSection??[]);

      });

      View::composer(['website.sections.asideNews'],function($view) {
          $topNews = Helpers::cacheRemember("asideNews",60, function ()  {
                      return News::select('title','slug','id','imageId','sectionId')->where('status','published')->orderby("publish_date","desc")->limit(4)->get();
                      });
          $view->with('topNews',$topNews??[]);
      });

      View::composer(['website.sections.asideArticles'],function($view) {
          $topNews = Helpers::cacheRemember("asideArticles",60, function ()  {
                      return  Articles::select('title','slug','id','imageId','sectionId','publisher_name')->where('status','published')->orderby("publish_date","desc")->limit(4)->get();
                      });
          $view->with('topNews',$topNews??[]);
      });

      View::composer(['website.layout.header'],function($view) {
      $data = Helpers::cacheRemember("socailMedia",1, function ()  {
                  return  OrderOfItems::select('data')->where('type','socailMedia')->first();
                  });
      $keywords = Helpers::cacheRemember("search_Keywords",60*24, function ()  {
                  $keywords  =  DB::table('news_keywords')
                       ->select('keyword_Id', DB::raw('count(*) as total'))
                       ->groupBy('keyword_Id')->limit(6)
                       ->get()->pluck('keyword_Id');
             return  keywords::select('name','slug','id')->whereIn('id',$keywords)->get();
                  });

      $data = isset($data)?$data->data:null;
          $view->with('socailLinks',$data??[]);
          $view->with('keywords',$keywords??[]);
      });

      View::composer(['website.layout.footer'],function($view) {
      $data = Helpers::cacheRemember("socailMedia",1, function ()  {
                  return  OrderOfItems::select('data')->where('type','socailMedia')->first();
                  });
      $data = isset($data)?$data->data:null;
          $view->with('socailLinks',$data??[]);
      });




    }
}
