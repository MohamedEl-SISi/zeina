<?php

namespace App\Http\Helpers;

use DateTime;
use Auth;
use Session;
use Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Cache;

class Helpers
{

  static function cacheRemember($key, $time, $callback)
  {
      //time in second
      return Cache::remember($key, $time *60 , $callback);
  }

    public static function writeLog($message)
    {
        echo $message . PHP_EOL;
    }

    public static function apiResponse($data,$status=1, $message="", $statusCode = 200)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "data" => $data
        ], $statusCode);
    }
    static function parseDateGoogleFormat($date)
    {
    try {
        if ($date instanceof UTCDateTime) {
            $date = $date->toDateTime();
        }
        return \Carbon\Carbon::parse($date)
            ->format('Y-m-d\TH:i:s.uP');
    } catch (\Exception $e) {
        return null;
    }
    }

    public static function search($keyword)
{
  $keywords = str_replace('"','',$keyword);
  $keywords = str_replace(' من','',$keywords);
  $keywords = str_replace(' في','',$keywords);
  $keywords = str_replace(' حتي','',$keywords);
  $keywords = str_replace(' عن','',$keywords);
  $keywords = str_replace(' بعد','',$keywords);
  $keywords = str_replace('  ',' ',$keywords);
  $keywords = str_replace('   ',' ',$keywords);
  $keywords = explode(" ", $keyword);
  $new_array_search = [];
    foreach ($keywords as $key => $keyword) {
      if(count($keywords)==1)
      {
         array_push($new_array_search,
           str_replace('أ', 'ا', $keyword),
           str_replace('ة', 'ه', $keyword),
           str_replace('ه','ة', $keyword),
           str_replace('أ', 'ا', $keyword),
           str_replace('إ', 'ا', $keyword),
           str_replace('آ', 'ا', $keyword),
           str_replace('ا','أ', $keyword),
           str_replace('ا', 'إ', $keyword),
           str_replace('ا', 'آ', $keyword),
           str_replace('ي', 'ى', $keyword),
           str_replace('ى', 'ي', $keyword)
        );
      }else
      {
        if($key != ( count($keywords) - 1)  )
        {
          array_push($new_array_search,$keyword);
          $word = $keyword.' '.$keywords[$key+1];
          array_push($new_array_search,$word);
        }else
        {
          array_push($new_array_search,$keyword);
        }
      }
    }

 return($new_array_search);
}

    public static function ReplaceSpaceByDash($text)
    {
        $text = preg_replace('[^A-Za-z0-9\-]', '', $text);
        $text = preg_replace('%/%', '', $text);
        $text = str_replace("|", '', $text);
        $text = str_replace('"', "", $text);
        $text = str_replace(".", "", $text);
        $text = str_replace(":", " ", $text);
        $text = str_replace("-", " ", $text);
        $text = str_replace('"', " ", $text);
        $text = str_replace("'", " ", $text);
        $text = str_replace("(", " ", $text);
        $text = str_replace(")", " ", $text);
        $text = str_replace("  ", " ", $text);
        $text = str_replace("   ", " ", $text);
        $text = str_replace(' ','-',$text);
        return  str_replace('--','-',$text);
    }
    public static function UnSerializeData($post)
    {
        if(is_array($post))
        {
            $new_post= array_map(function ($item) {
                $item = unserialize($item);
                if(isset($item['_id']))
                {
                    $item['id']=$item['_id'];
                    unset($item['_id']);
                }
                return $item;
            }, $post);
        }else
        {

            $new_post[]=unserialize($post);
             if(isset($new_post[0]['_id']))
             {
                 $new_post[0]['id']=$new_post[0]['_id'];
                 unset($new_post[0]['_id']);
             }

        }

        return $new_post;
    }

    public static function toArrayandeditID($model)
    {
        $model=$model->toArray();
        $model['id']=$model['_id'];
        unset($model['_id']);
        return $model;
    }
    public static function SerializeDataForSelect($post)
    {

        if(!is_array($post))
        {
            $post = $post->toArray();
        }
        $new_post =  array_map(function($item){
            if(isset($item['_id']))
            {
                $item['id']=$item['_id'];
                unset($item['_id']);
            }
              $test['id']=serialize($item);
             $test['name']=$item['name'];
            return $test;
        },$post);
        return $new_post;
    }
    public static function makedir($dir)
    {
        $direction=explode("/",$dir);
        $newdir='';
        foreach ($direction as $key=> $single_dir)
        {

            for ($i = 0 ; $i<=$key ; $i++)
            {
                if($i)
                {
                    $newdir = $newdir.'/'.$direction[$i];
                }else
                {
                    $newdir = $direction[$i];
                }

            }

            if( $newdir != "" && is_dir($newdir) === false )
            {
                mkdir($newdir, 0775, true);
                chmod($newdir,0775);
            }
            else if($newdir == "" && is_dir($dir) === false)
            {

                mkdir($dir, 0775, true);
                chmod($newdir,0775);
            }
        }
        return $dir;
    }
    static function getKeyValues($array, $key)
    {
        $array = collect($array);
        return $array->pluck($key)->toArray() ?? null;
    }


    public static function getImageUrl($imgId, $size = "src",$path)
    {
        return  url('images/'. $size . '/' .$path.'/'. $imgId);
    }


    public static function MonthArabic()
    {
       return  ["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونية",
            "يوليو", "اغسطس", "سبتمبر", "اكتوبر", "نوفمبر", "ديسمير"
        ];
    }
    public static function DaysArabic()
    {
        return  ['الاحد', 'الاثنين', 'الثلاثاء', 'الاربعاء', 'الخميس', 'الجمعه', 'السبت'];
    }

    public static function DaysEnglish()
    {
        return  ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    }

    public static function EditNewsBody($contents)
    {
      $body ='';

      foreach($contents as $content)
      {
                if(!is_null($content['title']))
                {
                  $header = html_entity_decode('<br><h4>'.$content['title'].'</h4>');
                }

                if(count($content['photos']??[]))
                {
                  foreach($content['photos'] as $Albumkey => $photo )
                  {
                    $size = isset($content['size'])?$content['size'][$Albumkey]:'600x340';
                    if($size == "src" && !isset($photo['have_source']) )
                    {
                      $size = "600x340";
                    }

                    $photoUrl    =  self::getImageUrl($photo['imageId'],$size,$photo['path']);
                    $images = html_entity_decode('<img src="'.$photoUrl.'" width="320" height="200">');
                  }
                }

                if(!is_null($content['youtube']))
                {
                  $content['youtube'] = substr($content['youtube'], 0, strpos($content['youtube'], "&"));
                  $content['youtube'] = str_replace("watch?v=","embed/",$content['youtube']);
                  $content['youtube'] = str_replace(".be/","be.com/embed/",$content['youtube']);
                  $YIframe = html_entity_decode('<iframe src="'.$content['youtube'].'"></iframe>');
                }
                $content['content'] = strip_tags($content['content']);

                $body = $body .($header ?? '').($images ?? '').($YIframe ?? ''). html_entity_decode($content['content']).$content['video'];
          }

          $body= strip_tags($body);
          // dd($body,strip_tags($body));
        return  $body;
    }

    static function IsMobile()
    {
        return (self::DetectDevice() != "desktop" && self::DetectDevice() != "bot") ? true : false;
    }

    static function DetectDevice()
    {
        $userAgent = $_SERVER["HTTP_USER_AGENT"] ?? null;
        $devicesTypes = array(
            "desktop" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*safari", "macintosh.*firefox", "opera"),
            "tablets" => array("tablet", "android", "ipad", "tablet.*firefox"),
            "mobile" => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
            "bot" => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
        );
        $deviceName = "";
        foreach ($devicesTypes as $deviceType => $devices) {
            foreach ($devices as $device) {
                if (preg_match("/" . $device . "/i", $userAgent)) {
                    $deviceName = $deviceType;
                }
            }
        }
        return $deviceName;
    }
}
