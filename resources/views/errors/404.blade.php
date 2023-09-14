@extends(lp() ?: 'top.'.'layouts.master')

@section('title', '404 Not Found｜PayTech(ペイテック)')
@section('description', '申し訳ありません。お探しのページは見つかりませんでした。もしご不明な点やお困りのことがございましたら、お手数ですが弊社のサポートチームまでお問い合わせください。')
@push('head')
<link rel="stylesheet" href="{{ template('/css/top.css?v20232628') }}">
<script type="application/ld+json">
 {
   "@context": "https://schema.org",
   "@type": "BreadcrumbList",
   "itemListElement": [
     {
     "@type": "ListItem",
     "position": 1,
     "name": "PayTech（ペイテック） TOP",
     "item": "https://paytech-factoring.com/"
     },
     {
       "@type": "ListItem",
       "position": 2,
       "name": "404 Not Found",
       "item": "https://paytech-factoring.com/404/"
     }
   ]
 }
</script>
@endpush

@section('content')
<div class="section section-page section__thanks">
  <div class="page-content">
    <div class="container">
    
      <h1 class="title-public fadein" data-aos="show">
      404 NOT FOUND
      </h1>
      
      <div class="thank-content fadein" data-aos="show">
        <p>アクセスしようとしたページは<br class="only-sp">見つかりませんでした。</p>
        <p>このエラーは、指定したページが<br class="only-sp">見つからなかったことを意味します。</p>
        <p>以下のような原因が考えられます。</p>
        <p>アクセスしようとしたファイルが存在しない（ファイルの設置箇所を誤っている）。</p>
        <p>URLアドレスが間違っている。</p>
        <p class="back-to-top">
          <a href="{{ route(lp().'home') }}">TOPへ戻る</a>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection

@push('footer')

<link
    href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Noto+Sans+JP:wght@300;400;500;700;900&display=swap"
    rel="stylesheet">
<script src="{{ template('/libs/jquery-3.6.1.min.js') }}"></script>
<script src="{{ template('/libs/aos/aos.js') }}"></script>
<script src="{{ template('/js/script.js') }}"></script>
@endpush