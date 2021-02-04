<?php


namespace ZeinaDev\Services\Domain;
use App\Core\Services\BaseService;
use App\Http\Helpers\Helpers;
use ZeinaDev\Repository\Interfaces\ImagesRepositoryInterface;
use ZeinaDev\Services\Interfaces\ImagesServiceInterface;
use ImageModel;
use Storage;

class ImagesService extends BaseService implements ImagesServiceInterface
{

        public function __construct(ImagesRepositoryInterface $imagesRepository )
        {
            $this->_repo   = $imagesRepository;
        }

        function AttributeCustom($request,$id = null)
        {
               $model= array(
                'title'            => $request->title,
                'path'             => now()->year.'/'.now()->month,
                'fileName'         => Helpers::ReplaceSpaceByDash($request->title).'_'.time().'.jpg',
                'photo'            =>request()->photo,
            );

            if(!is_null(request()->photo))
            {
                $this->saveImagePath($model);
            }
            unset($model['photo']);

            return $model;
        }

        function saveToArray($data)
        {
            $data['title'] = Helpers::ReplaceSpaceByDash($data['title']);
            $data['path'] =now()->year.'/'.now()->month;
            $data['fileName'] = $data['title'].'_'.time().'.jpg';
            $this->saveImagePath($data);
            unset($data['photo']);
            $image = $this->_repo->create($data);
            return $image->id;
        }

        function saveImagePath($Image)
        {

          $dir = 'images/src/'.$Image['path'];
          $dir = Helpers::makedir($dir);
          $imageName = $Image['fileName'];
          ImageModel::make($Image['photo'])->save($dir.'/'.$imageName, 95);
          chmod($dir.'/'.$imageName,0775);
            $mediaSizes = explode(",", getenv('MediaSizes'));
            foreach ($mediaSizes as $size)
            {
                $dir = 'images/'.$size.'/'.$Image['path'];
                $dir = Helpers::makedir($dir);
                ob_start();

                list($width, $height,$image_type) = getimagesize($Image['photo']);
                $newwidth =explode('x', $size)[0];
                $newheight =explode('x', $size)[1];

                $thumb = \imagecreatetruecolor($newwidth, $newheight);

                switch ($image_type)
                {
                    case 1: $source = \imagecreatefromgif($Image['photo']); break;
                    case 2: $source = \imagecreatefromjpeg($Image['photo']);  break;
                    case 3: $source = \imagecreatefrompng($Image['photo']); break;
                    //default: return '';  break;
                }

                $width=explode('x', $size)[0];
                $height=explode('x', $size)[1]; // my final thumb
                $ratio_thumb=$width/$height; // ratio thumb

                list($xx, $yy) = getimagesize($Image['photo']); // original size
                $ratio_original=$xx/$yy; // ratio original

                if ($ratio_original>=$ratio_thumb) {
                    $yo=$yy;
                    $xo=ceil(($yo*$width)/$height);
                    $xo_ini=ceil(($xx-$xo)/2);
                    $xy_ini=0;

                } else {
                    $xo=$xx;
                    $yo=ceil(($xo*$height)/$width);
//                    $xy_ini=ceil(($yy-$yo)/2);
                    $xo_ini=0;
                    $xy_ini =0;

//                    dd($xo_ini,$xy_ini,$xo,$yo);
                }

                imagecopyresampled($thumb, $source, 0, 0, $xo_ini, $xy_ini, $width, $height, $xo, $yo);

                switch ($image_type)
                {
                    case 1: \imagegif($thumb); break;
                    case 2: \imagejpeg($thumb, NULL, 95);  break; // best quality
                    case 3: \imagepng($thumb, NULL, 9); break; // no compression
                }
                $imageStream=ob_get_contents();
                $imageName = $Image['fileName'];
                ImageModel::make($imageStream)->resize($width, $height)->save($dir.'/'.$imageName, 95);
                chmod($dir.'/'.$imageName, 0775);

                imagedestroy($thumb);

                ob_end_clean();
            }


            return true;
        }



        function  deleteById($id)
        {
            $this->unlinkphoto($id);
            $this->_repo->deleteById($id);


            return true;
        }

    function unlinkphoto($id)
    {
        $image      = $this->_repo->getById($id);
        $mediaSizes = explode(",", getenv('MediaSizes'));
        foreach ($mediaSizes as $size)
        {
            try{
                @unlink(public_path('/images/'.$size.'/'.$image->path.'/'.$image->encryptedImageId.'.jpg'));
                $imageUrl = Helpers::getImageUrl($image->imageId, $size ,$image->path);
                @unlink($imageUrl);
                $imageUrlWeb = Helpers::getImageUrlWeb($image->imageId, $size ,$image->path);
                @unlink($imageUrlWeb);
            } catch(\Exception $ex)
            {

            }

        }

        @unlink(public_path('/images/src/src/'.$image->encryptedImageId.'.jpg'));

    }

    function saveImageApi($request ,$id)
    {
            $data = $request->image;

            $image_array_1 = explode(";", $data);

            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);

            $Image = $this->getById($id);
            $size = $request->size;

            $width= explode('x', $size)[0];
            $height= explode('x', $size)[1];

            $dir = 'images/'.$size.'/'.$Image->path;

            $imageName = $Image->fileName;
            $data =  ImageModel::make($data)->resize($width, $height)->save($dir.'/'.$imageName, 95);
        return true;
    }

    function saveAlbum($request)
    {
        foreach (request()->album as $key=> $image_album)
              {
                  $singleAlbum=array(
                      'title'=>$request->title.($key+1),
                      'photo'=>$image_album
                  );
                  $album = $this->saveToArray($singleAlbum);
              }

        return true;
    }
}
