@php
    $listIndex=1;
@endphp
<script  type="application/ld+json">
    {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
    {
    "@type": "ListItem",
    "position": {{$listIndex}},
    "name": "الرئيسية",
    "item": "{{env("APP_URL")}}"
    }
    @if(isset($categoryUrl)&&isset($categoryTitle))
        ,
        {
        "@type": "ListItem",
        "position": {{ ++$listIndex}},
        "name": "{{$categoryTitle}}",
        "item": "{{$categoryUrl}}"
        }
    @endif
    @if(isset($postUrl)&&isset($postTitle))
        ,
        {
        "@type": "ListItem",
        "position": {{++$listIndex}},
        "name": "{{$postTitle}}",
        "item": "{{$postUrl}}"
        }
    @endif
    ]
    }
</script>
