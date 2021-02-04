<?php


namespace ZeinaDev\Services\Interfaces;

interface WebsiteInterface
{
    function HomeData();

    function newsSection($slug);

    function newsSectionapi($slug);

    function newsSingle($id,$slug);

    function articles();

    function articlesSection($slug);

    function articleSectionapi($slug);

    function articleSingle($id,$slug);

    function files();

    function filesApi();

    function fileSingle($id,$slug);

    function newstags($slug);

    function newstagsapi($slug);

    function search($q);

    function searchapi($q);

    function exam();

    function examSection($slug);

    function examApi($slug = null);

    function examSingle($id,$slug);

}
