@inject('_datesHelper','App\Http\Helpers\Helpers')


<script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{urldecode (Request::url())}}"
            },
            "headline": "{{$title}}",
            "image": [
             "{{$imageUrl}}"
            ],
            "datePublished": "{{$_datesHelper::parseDateGoogleFormat($publishDate)}}",
            "dateModified": "{{$_datesHelper::parseDateGoogleFormat($modifiedDate)}}",
            "author": {
            "@type": "Person",
            "name": "{{$editorName ?? "زينة"}}"
            },
                "publisher": {
                "@type": "Organization",
                "name": "زينة",
                    "logo": {
                    "@type": "ImageObject",
                    "url": "{{env("APP_URL")}}/logo.png"
                    }
                }
        }
</script>
