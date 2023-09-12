@extends('top.layouts.master')

@section('title', 'お申し込みフォーム｜PayTech -ペイテック-')
@section('description', '『PayTech(ペイテック)』のお申し込みフォームページになります。査定は無料で行いますので、こちらのフォームからお申し込み下さい。')
@push('head')
<link rel="stylesheet" href="{{ template('css/form.css?3') }}">
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [{
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
      }
    ]
  }
</script>

@endpush


@section('content')
<main>
  <section id="contact" class="contact section section__contact">
    <div class="container">
      <div id="breadcrumb">
        <a href="{{ route(lp().'home') }}">PAYTECH TOP</a>　>　<span class="breadcrumb_last" aria-current="page">お申し込みフォーム</span>
      </div>

      <h1 id="contact-title" class="title-public section-title" data-aos="show"> お申し込みフォーム</h1>

      <form method="POST" action="{{ route(lp().'submit') }}" id="applyForm" enctype="multipart/form-data">
        @csrf
        @if (isset($data))
          <input type="hidden" name="company_name" value="{{ $data->company_name }}">
          <input type="hidden" name="prefect" value="{{ $data->prefect_txt }}">
          <input type="hidden" name="city" value="{{ $data->city_txt }}">
          <input type="hidden" name="company_size" value="{{ $data->company_size }}">
          <input type="hidden" name="receivable_capital" value="{{ $data->receivable_capital }}">
          <input type="hidden" name="business_history" value="{{ $data->business_history }}">
          <input type="hidden" name="number_of_transactions" value="{{ $data->number_of_transactions }}">
          <input type="hidden" name="has_contract" value="{{ $data->has_contract }}">
          <input type="hidden" name="quick_was_used" value="{{ $data->quick_was_used }}">
          <input type="hidden" name="billing" value="{{ $data->billing }}">
          <input type="hidden" name="percent" value="{{ $data->percent }}">
          <input type="hidden" name="fundraising_percent" value="{{ $data->fundraising_percent }}">
          <input type="hidden" name="fundraising_price" value="{{ $data->fundraising_price }}">
        @endif
        <!-- <h1>TESTING</h1> -->
        <div class="tab">
        @if (isset($data))
            <h2 class="form-title">■買取価格のシミュレート</h2>
            <table class="table table-apply table-apply-step">
              <tbody>
                <tr>
                  <th>売掛先企業</th>
                  <td>{{ $data->company_name }}</td>
                </tr>
                <tr>
                  <th>売掛先企業の本社所在地</th>
                  <td>{{ $data->prefect_txt }}{{ $data->city_txt }}
                  </td>
                </tr>
                <tr>
                  <th>売掛先の企業規模</th>
                  <td>{{ $data->company_size }}</td>
                </tr>
                <tr>
                  <th>売掛先の資本金</th>
                  <td>{{ $data->receivable_capital }}
                  </td>
                </tr>
                <tr>
                  <th>売掛先の業歴</th>
                  <td>{{ $data->business_history }}
                  </td>
                </tr>
                <tr>
                  <th>売掛先とのお取引回数</th>
                  <td>{{ $data->number_of_transactions }}
                  </td>
                </tr>
                <tr>
                  <th>売掛先との契約書の有無</th>
                  <td>{{ $data->has_contract }}</td>
                </tr>
                <tr>
                  <th>PAYTECH-ペイテック-のご利用回数</th>
                  <td>{{ $data->quick_was_used }}</td>
                </tr>
                <tr>
                  <th>売掛先へのご請求金額</th>
                  <td>{{ $data->billing }}万円</td>
                </tr>
                <tr>
                  <th>概算手数料</th>
                  <td>{{ $data->percent }}%〜</td>
                </tr>
                <tr>
                  <th>資金調達成功率</th>
                  <td>{{ $data->fundraising_percent }}%〜
                  </td>
                </tr>
                <tr>
                  <th>資金調達可能額</th>
                  <td>{{ $data->fundraising_price }}万円～
                  </td>
                </tr>
              </tbody>
            </table>
          @endif
          <h2 class="form-title">■お客様の情報をご入力</h2>
          <table class="table table-apply fadein" data-aos="show">
            <tbody>
              <tr>
                <th>
                  <label for="address" class="ttl-group">
                    お名前<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="text" id="address" name="address" placeholder="（例）売掛太郎" class="form-control" required="required">
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="phonenumber" class="ttl-group">
                    電話番号<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="tel" id="phonenumber" name="phonenumber" placeholder="（例）0358306464" class="form-control" required="required">
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="email" class="ttl-group">
                    メールアドレス<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="（例）paytech-fuctoring@mail.co.jp" class="form-control" required="required">
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="company" class="ttl-group">
                    ご住所<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="text" id="company" name="company" placeholder="（例）東京都台東区上野六丁目8番19号" class="form-control" required="required">
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="fullname" class="ttl-group">
                    会社名・屋号名<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="text" id="fullname" name="fullname" placeholder="（例）株式会社Realize" class="form-control" required="required">
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="amount" class="ttl-group">
                    買取希望金額<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <div class="in-row">
                      <input type="tel" name="amount" id="amount" placeholder="（例）300" class="form-control" required="required">万円
                    </div>
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label class="ttl-group">
                    ご希望のファクタリング形式<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group radio-btn">
                    <div class="in-row">
                      <input type="radio" name="format" id="format" value="2社間ファクタリング" checked><label for="format">2社間ファクタリング</label>
                    </div>
                    <div class="in-row">
                      <input type="radio" name="format" id="format1" value="3社間ファクタリング"><label for="format1">3社間ファクタリング</label>
                    </div>

                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>

            </tbody>
          </table>
          <h2 class="form-title">■売掛先の企業様の情報をご入力</h2>
          <table class="table table-apply fadein" data-aos="show">
            <tbody>
              <tr>
                <th>
                  <label for="company_office" class="ttl-group">
                    売掛先の企業名<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="text" id="company_office" name="company_office" placeholder="（例）売掛株式会社" class="form-control" required="required">
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>

              <tr>
                <th>
                  <label for="company_address" class="ttl-group">
                    売掛先の所在地<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="text" id="company_address" name="company_address" placeholder="（例）東京都台東区上野六丁目8番19号" class="form-control" required="required">
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="company_other" class="ttl-group">
                    その他情報
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <textarea name="company_other" id="company_other" class="form-control" cols="30" rows="6" placeholder="※その他補足などあればご記入"></textarea>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="company_phone_my" class="ttl-group">
                    電話番号
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="tel" id="company_phone_my" name="company_phone_my" placeholder="（例）0358306464" class="form-control">
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <h2 class="form-title">■必要書対の画像を添付</h2>
          <div class="form-note">
            ※添付可能な画像のファイル形式はPDF・JPEG・PNGとなります。<br>
            ※添付ボタン1つにつき、添付可能な画像容量は5MBまでになります。
          </div>
          <table class="table table-apply fadein" data-aos="show">
            <tbody>

              <tr>
                <th>
                  <label for="photo_id_1" class="ttl-group">
                    身分証明書（前面）<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="file" id="photo_id_1" name="photo_id_1" class="form-control file_input" required="required">
                    <div id="photo_id_1_preview" class="preview"></div>
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr class="nonbr">
                <th>
                  <label for="photo_id_2" class="ttl-group">
                    身分証明書（裏面）<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="file" id="photo_id_2" name="photo_id_2" class="form-control file_input" required="required">
                    <div id="photo_id_2_preview" class="preview"></div>
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr class="nonbr">
                <td colspan="2" class="twoblock">※運転免許，パスポート，マイナンバーカードなど顔が映った写真</td>
              </tr>
              <tr>
                <th>
                  <label for="photo_bill" class="ttl-group">
                    売掛先の<br>
                    請求書・注文書データ<span class="required">(必須)</span>
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="file" id="photo_bill" name="photo_bill" class="form-control file_input" required="required">
                    <div id="photo_bill_preview" class="preview"></div>
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="photo_item" class="ttl-group">成因証書データ</label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="file" id="photo_item" name="photo_item" class="form-control file_input">
                    <div id="photo_item_preview" class="preview"></div>
                    <div class="help-block with-errors"></div>
                  </div>
                </td>
              </tr>
              <tr class="nonbr">
                <td colspan="2" class="twoblock">※契約書，発注書，見積書などの画像データ</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="tab">
          <div class="confirm-note">
            以下の内容でよろしければ<br class="only-sp">「送信する」を押してください。
          </div>

          @if (isset($data))

            <h2 class="form-title">■買取価格のシミュレート</h2>
            <table class="table table-apply table-apply-step">
              <tbody>
                <tr>
                  <th>売掛先企業</th>
                  <td>{{ $data->company_name }}</td>
                </tr>
                <tr>
                  <th>売掛先企業の本社所在地</th>
                  <td>{{ $data->prefect_txt }}{{ $data->city_txt }}
                  </td>
                </tr>
                <tr>
                  <th>売掛先の企業規模</th>
                  <td>{{ $data->company_size }}</td>
                </tr>
                <tr>
                  <th>売掛先の資本金</th>
                  <td>{{ $data->receivable_capital }}
                  </td>
                </tr>
                <tr>
                  <th>売掛先の業歴</th>
                  <td>{{ $data->business_history }}
                  </td>
                </tr>
                <tr>
                  <th>売掛先とのお取引回数</th>
                  <td>{{ $data->number_of_transactions }}
                  </td>
                </tr>
                <tr>
                  <th>売掛先との契約書の有無</th>
                  <td>{{ $data->has_contract }}</td>
                </tr>
                <tr>
                  <th>PAYTECH-ペイテック-のご利用回数</th>
                  <td>{{ $data->quick_was_used }}</td>
                </tr>
                <tr>
                  <th>売掛先へのご請求金額</th>
                  <td>{{ $data->billing }}万円</td>
                </tr>
                <tr>
                  <th>概算手数料</th>
                  <td>{{ $data->percent }}%〜</td>
                </tr>
                <tr>
                  <th>資金調達成功率</th>
                  <td>{{ $data->fundraising_percent }}%〜
                  </td>
                </tr>
                <tr>
                  <th>資金調達可能額</th>
                  <td>{{ $data->fundraising_price }}万円～
                  </td>
                </tr>
              </tbody>
            </table>
          @endif

          <h2 class="form-title">■お客様の情報をご入力</h2>
          <table class="table table-apply fadein" data-aos="show">
            <tbody>
              <tr>
                <th>お名前</th>
                <td>
                  <span id="address_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>電話番号</th>
                <td>
                  <span id="phonenumber_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>メールアドレス</th>
                <td>
                  <span id="email_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>ご住所</th>
                <td>
                  <span id="company_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>会社名・屋号名</th>
                <td>
                  <span id="fullname_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>買取希望金額</th>
                <td>
                  <span id="amount_confirm"></span>万円
                </td>
              </tr>
              <tr>
                <th>ご希望のファクタリング形式</th>
                <td>
                  <span id="format_confirm"></span>
                </td>
              </tr>

            </tbody>
          </table>
          <h2 class="form-title">■売掛先の企業様の情報をご入力</h2>
          <table class="table table-apply fadein" data-aos="show">
            <tbody>
              <tr>
                <th>売掛先の企業名</th>
                <td>
                  <span id="company_office_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>売掛先の所在地</th>
                <td>
                  <span id="company_address_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>その他情報</th>
                <td>
                  <span id="company_other_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>電話番号</th>
                <td>
                  <span id="company_phone_my_confirm"></span>
                </td>
              </tr>
            </tbody>
          </table>
          <h2 class="form-title">■必要書対の画像を添付</h2>
          <table class="table table-apply fadein" data-aos="show">
            <tbody>
              <tr>
                <th>身分証明書（前面・裏面）</th>
                <td>
                  <span id="photo_id_1_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>身分証明書（裏面）</th>
                <td>
                  <span id="photo_id_2_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>売掛先の<br>
                  請求書・注文書データ</th>
                <td>
                  <span id="photo_bill_confirm"></span>
                </td>
              </tr>
              <tr>
                <th>成因証書データ</th>
                <td>
                  <span id="photo_item_confirm"></span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="form-action ">
          <button type="button" class="previous">戻る</button>
          <button type="button" class="next">入力内容の確認へ</button>
          <button type="button" name="action" value="send" class="submit apply_link disabled">
            <span>送信する</span>

          </button>
        </div>
      </form>
    </div>
  </section>
</main>
@endsection

@push('footer')
<link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Noto+Sans+JP:wght@300;400;500;700;900&display=swap" rel="stylesheet">
<script src="{{ template('libs/jquery-3.6.1.min.js') }}"></script>
<script src="{{ template('libs/aos/aos.js') }}"></script>
<script src="//mozilla.github.io/pdf.js"></script>
<script src="{{ template('js/script.js') }}"></script>
<script src="{{ template('libs/jquery.jpostal.js') }}"></script>
<script src="{{ template('libs/kana_text.js') }}"></script>
<script src="{{ template('libs/jquery.validate.min.js') }}"></script>
<script src="{{ template('libs/jquery.validate.additional-methods.js') }}"></script>
<script src="{{ template('libs/multi-form.js') }}"></script>
<script src="{{ template('js/contact.js?v0307') }}"></script>
@endpush