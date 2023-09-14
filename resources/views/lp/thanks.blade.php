@extends('layouts.master')

@section('title', 'お申し込み送信完了｜PayTech -ペイテック-')
@section('description', 'この度は『PayTech(ペイテック)』にお申し込み頂き、誠にありがとうございます。')
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
          "name": "お申し込みフォーム",
          "item": "https://paytech-factoring.com/contact/"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "送信完了",
          "item": "https://paytech-factoring.com/thanks/"
        }
      ]
    }
  </script>
@endpush

@section('content')
<main>
    <div class="section section-page section__thanks">
      <div class="page-content">
        <div class="container">
        <div id="breadcrumb">
                  <a href="{{ route(lp().'home') }}">PAYTECH TOP</a>　>　<span class="breadcrumb_last" aria-current="page">送信完了</span>
              </div>
          <h1 class="title-public fadein" data-aos="show">
          送信完了
          </h1>
          <div class="thank-content fadein" data-aos="show">
            <p>
            この度は『PayTech-ペイテック-』へ<br>
              お申し込み頂き、<br class="sp-b">誠にありがとうございました。<br>
              ご記入頂いた情報は送信されました。<br>
              送信内容確認後、改めて<br class="sp-b">担当スタッフよりご連絡いたします。
            </p>
  
            <p>
              ご登録いただきましたメールアドレスに<br class="sp-b">確認メールをお送りしました。<br>
              万が一、メールが届かない場合は<br class="sp-b">トラブルの可能性がございますので<br>
              大変お手数ではございますが、<br class="sp-b">再度お申し込み頂くか<br>
              お電話にてお問い合わせくださいませ。
            </p>
  
            <p>
            今後とも『PayTech-ペイテック-』を<br>
              よろしくお願い申し上げます。
            </p>
  
            <p class="back-to-top">
              <a href="{{ route(lp().'home') }}">TOPへ戻る</a>
            </p>
          </div>
        </div>
      </div>
    </div>
</main> 
@endsection

@push('footer')
<link
    href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Noto+Sans+JP:wght@300;400;500;700;900&display=swap"
    rel="stylesheet">
<script src="{{ template('/libs/jquery-3.6.1.min.js') }}"></script>
<script src="{{ template('/libs/aos/aos.js') }}"></script>
<script src="{{ template('/js/script.js') }}"></script>

@endpush