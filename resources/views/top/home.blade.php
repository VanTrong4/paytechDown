@extends('top.layouts.master')

@section('title', 'PayTech(ペイテック)｜請求書を買取り最速最短で資金調達')
@section('description', '「売掛金の回収が間に合わない！」など資金調達のお悩みは尽きないものです。そのお悩み『PayTech(ペイテック)』にお任せください。業界“最速”の審査時間と業界“最安”の手数料を実現！資金調達でお悩みのお客様を手助けいたします。')
@push('head')
<link rel="stylesheet" href="{{ template('css/top.css?v20232628') }}">
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [{
        "@type": "ListItem",
        "position": 1,
        "name": "PayTech(ペイテック)",
        "item": "https://paytech-factoring.com/"
    }]
}
</script>
@endpush

@section('content')
<main>
    <div class="section__main">
        <div class="container">
            <div class="bg-main-left">
                <div class="box-top">
                    <h1 class="title">
                        <span class="title-first">法人・個人事業主 の方に朗報</span><br>
                        <span class="title-second">ファクタリングサービスで<br>
                            お持ちの売掛金を即現金化</span><br>
                        <span class="title-third">面倒な審査・会員登録・事業計画書の提出なども一切必要無し！<br>
                            お申し込みからご契約まで全てオンラインで完結！</span>
                    </h1>
                    <a href="{{ route(lp().'contact') }}" class="btn-text">お申し込みは数分で完了<br>
                        <span class="win">お申し込みフォームはこちら</span></a>
                </div>
                <div class="box-bottom">
                    <div class="sub-list">ご利用手数料は<br>
                        業界最安水準の<br>
                        手数料率を実現！
                    </div>
                    <div class="sub-list">
                        手続きは全て<br>
                        WEB完結<br>
                        24時間受付中！
                    </div>
                </div>
            </div>
            <div class="box-bottom sp1280">
                <div class="sub-list">ご利用手数料は<br>
                    業界最安水準の<br>
                    手数料率を実現！
                </div>
                <div class="sub-list">
                    手続きは全て<br>
                    WEB完結<br>
                    24時間受付中！
                </div>
            </div>
            <div class="bg-main-right">
                <div class="section__quick" id="quick">
                    <div class="quick-content">

                        <h2 class="section-title">買取価格をシミュレート</h2>
                        <div class="text-center">
                            以下のフォームから<br>
                            買取価格と手数料の<br>
                            確認することができます
                        </div>
                        <div>
                            <form method="POST" action="{{ route('gotoContact') }}" id="form_step">
                                @csrf
                                <input type="hidden" name="prefect_txt" id="prefect_txt">
                                <input type="hidden" name="city_txt" id="city_txt">
                                <div class="tab">
                                    <div class="step_text">売掛先企業</div>
                                    <div class="step_group">
                                        <input type="text" placeholder="（例）株式会社Realize" name="company_name"
                                            id="company_name" value="">
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="step_text">都道府県</div>
                                    <div class="step_group ">
                                        <div class="prefect">
                                            <select id="prefect" name="prefect" required>
                                                <option value="">都道府県を選択</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="step_text">市町村</div>
                                    <div class="step_group ">
                                        <div class="prefect">
                                            <select id="city" name="city" required>
                                                <option value="">市区町村を選択</option>
                                            </select>
                                        </div>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="form-action">
                                        <button type="button" class="btn next">先へ進む</button>
                                    </div>
                                </div>

                                <div class="tab">
                                    <div class="step_lines">
                                        <div class="step_text">売掛先の企業規模</div>
                                        <div class="radio_wrap">
                                            <input type="radio" id="company_size_1" data-percent="1" name="company_size"
                                                value="上場企業">
                                            <label for="company_size_1">上場企業</label>
                                            <input type="radio" id="company_size_2" data-percent="3" name="company_size"
                                                value="非上場企業">
                                            <label for="company_size_2">非上場企業</label>
                                            <input type="radio" id="company_size_3" data-percent="1" name="company_size"
                                                value="国・自治体">
                                            <label for="company_size_3">国・自治体</label>
                                            <input type="radio" id="company_size_4" data-percent="5" name="company_size"
                                                value="不明">
                                            <label for="company_size_4">不明</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="step_lines">
                                        <div class="step_text">売掛先の資本金</div>
                                        <div class="radio_wrap">
                                            <input type="radio" id="receivable_capital_1" name="receivable_capital"
                                                value="1億円以上">
                                            <label for="receivable_capital_1">1億円以上</label>
                                            <input type="radio" id="receivable_capital_2" name="receivable_capital"
                                                value="1億～5,000万円">
                                            <label for="receivable_capital_2">1億～5,000万円</label>
                                            <input type="radio" id="receivable_capital_3" name="receivable_capital"
                                                value="5,000万円～1,000万円">
                                            <label for="receivable_capital_3">5,000万円～1,000万円</label>
                                            <input type="radio" id="receivable_capital_4" name="receivable_capital"
                                                value="1,000万円以下">
                                            <label for="receivable_capital_4">1,000万円以下</label>
                                            <input type="radio" id="receivable_capital_5" name="receivable_capital"
                                                value="不明">
                                            <label for="receivable_capital_5">不明</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="step_lines">
                                        <div class="step_text">売掛先の業歴</div>
                                        <div class="radio_wrap">
                                            <input type="radio" id="business_history_1" name="business_history"
                                                value="50年以上">
                                            <label for="business_history_1">50年以上</label>
                                            <input type="radio" id="business_history_2" name="business_history"
                                                value="50年～10年">
                                            <label for="business_history_2">50年～10年</label>
                                            <input type="radio" id="business_history_3" name="business_history"
                                                value="10年～5年">
                                            <label for="business_history_3">10年～5年</label>
                                            <input type="radio" id="business_history_4" name="business_history"
                                                value="5年以下">
                                            <label for="business_history_4">5年以下</label>
                                            <input type="radio" id="business_history_5" name="business_history"
                                                value="不明">
                                            <label for="business_history_5">不明</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="step_lines">
                                        <div class="step_text">売掛先とのお取引回数</div>
                                        <div class="radio_wrap">
                                            <input type="radio" id="number_of_transactions_1" data-percent="3"
                                                name="number_of_transactions" value="初回取引">
                                            <label for="number_of_transactions_1">初回取引</label>
                                            <input type="radio" id="number_of_transactions_2" data-percent="1"
                                                name="number_of_transactions" value="継続取引">
                                            <label for="number_of_transactions_2">継続取引</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="step_lines">
                                        <div class="step_text">売掛先との契約書の有無</div>
                                        <div class="radio_wrap">
                                            <input type="radio" id="has_contract_1" data-percent="1" name="has_contract"
                                                value="有り">
                                            <label for="has_contract_1">有り</label>
                                            <input type="radio" id="has_contract_2" data-percent="3" name="has_contract"
                                                value="無し">
                                            <label for="has_contract_2">無し</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab">
                                    <div class="step_lines">
                                        <div class="step_text">PAYTECH-ペイテック-のご利用回数</div>
                                        <div class="radio_wrap">
                                            <input type="radio" id="quick_was_used_1" name="quick_was_used" value="初回">
                                            <label for="quick_was_used_1">初回</label>
                                            <input type="radio" id="quick_was_used_2" name="quick_was_used"
                                                value="2回目以降">
                                            <label for="quick_was_used_2">2回目以降</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab" data-callback="inputMoney">
                                    <div class="step_lines">
                                        <div class="step_text">現状の概算手数料</div>
                                        <div class="step_line">
                                            <span class="label">売掛先企業</span><span class="value company_name_txt"></span>
                                        </div>
                                        <div class="step_line">
                                            <span class="label">概算手数料</span><span class="value"><strong><b
                                                        id="percent_txt"></b>％～</strong></span>
                                        </div>
                                        <div class="step_text">売掛先へのご請求金額</div>
                                        <div class="step_group step_group_price">
                                            <input type="number" placeholder="例）100" name="billing" id="billing_text"
                                                onkeyup="if(this.value>9999){this.value='9999';}else if(this.value<0){this.value='0';}"
                                                class="amount"><span>万円</span>
                                            <div class="help-block"></div>
                                        </div>
                                        <div class="step_table_preview" id="step_table_preview">
                                        </div>
                                        <div class="form-action">

                                            <button type="button" class="previous pow-back">前に戻る</button>
                                            <button type="button" class="btn next pow-next">スタート</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab" data-callback="calcMoney">

                                    <input type="hidden" name="percent" id="percent">
                                    <input type="hidden" name="fundraising_percent" id="fundraising_percent">
                                    <input type="hidden" name="fundraising_price" id="fundraising_price">
                                    <div class="step_lines">
                                        <div class="step_text">査定結果</div>
                                        <div class="step_line">
                                            <span class="label">売掛先企業</span><span class="value company_name_txt"></span>
                                        </div>
                                        <div class="step_line">
                                            <span class="label">概算手数料</span><span class="value"
                                                id="approximate_fee"></span>
                                        </div>
                                        <div class="step_line">
                                            <span class="label">資金調達成功率</span><span class="value"
                                                id="fundraising_rate"><strong><b>98.0</b>％～<b>99.0</b>％</strong></span>
                                        </div>
                                        <div class="step_line">
                                            <span class="label">資金調達可能額</span><span class="value"
                                                id="price_percent"></span>
                                        </div>
                                        <div class="step_table_preview" id="step_table_calc_preview">
                                        </div>
                                        <div class="step_group_action form-action ">
                                            <button type="button" class="previous pow-back">前に戻る</button>
                                            <button type="submit" class="btn submit pow-next">申し込む</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-action" id="common_form_action">
                                    <button type="button" class="previous">前に戻る</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section__tech">
        <div class="container">
            <h2 class="title-public">資金調達でよくあるお悩み</h2>
            <div class="box-three">
                <div class="sub">取引先からの遅延で<br>
                    事業資金の確保が厳しい...</div>
                <div class="sub">融資を断られて<br>
                    資金調達が難航している...</div>
                <div class="sub">出費や新規事業などで<br>
                    資金不足に陥っている...</div>
            </div>
            <p class="two-men">
                <img src="{{ template('images/two-men.png') }}" alt="握手をするサラリーマン">
            </p>
            <p class="content-tech">その様な悩みは<br>
                <span class="blue">PayTech -ペイテック-</span><br>
                にお任せください！
            </p>
            <div class="list-btn-low">
                <div class="sub">
                    <p class="img"><img src="{{ template('images/icon-ls-01.png') }}" alt="お申し込みフォームはこちら"></p>
                    <p class="title">日本全国24時間受付中</p>
                    <p class="btn-ls"><a href="{{ route(lp().'contact') }}" class="btn">お申し込みフォームはこちら</a></p>
                </div>
                <div class="sub">
                    <p class="img"><img src="{{ template('images/icon-ls-02.png') }}" alt="計算シミュレーターはこちら"></p>
                    <p class="title">買取金額と概算手数料を知りたい方</p>
                    <p class="btn-ls"><a href="{{ route(lp().'home') . '#quick' }}" class="btn">計算シミュレーターはこちら</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="section__kame">
        <div class="container">
            <h2 class="title-public">ファクタリングの流れ</h2>
            <div class="content-gin">PayTech-ペイテック-では<br>
                売掛金の買取方法は<br class="sp-b">2種類方法がございます。</div>
            <div class="list-two-kame">
                <div class="sub">
                    <p class="title">2社間ファクタリング</p>
                    <p class="img">
                        <img src="{{ template('images/img-price-01.png') }}" alt="2社間ファクタリング">
                    </p>
                </div>
                <div class="sub">
                    <p class="title">3社間ファクタリング</p>
                    <p class="img">
                        <img src="{{ template('images/img-price-02.png') }}" alt="3社間ファクタリング">
                    </p>

                </div>
            </div>

        </div>
    </div>
    <div class="section__yau">
        <div class="container">
            <div class="title-yaw">PayTech -ペイテック-<br class="sp-b">のサービスなら<br>
                面倒な手続き一切無し！<br>
                最短30分で審査完了！</div>
            <div class="list-btn-low">
                <div class="sub">
                    <p class="img"><img src="{{ template('images/icon-ls-01.png') }}" alt="日本全国24時間受付中"></p>
                    <p class="title">日本全国24時間受付中</p>
                    <p class="btn-ls"><a href="{{ route(lp().'contact') }}" class="btn">お申し込みフォームはこちら</a></p>
                </div>
                <div class="sub">
                    <p class="img"><img src="{{ template('images/icon-ls-02.png') }}" alt="買取金額と概算手数料を知りたい方"></p>
                    <p class="title">買取金額と概算手数料を知りたい方</p>
                    <p class="btn-ls"><a href="{{ route(lp().'home') . '#quick' }}" class="btn">計算シミュレーターはこちら</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="section__step">
        <div class="container">
            <h2 class="title-public">PayTech -ペイテック-<br class="sp-b">のメリット</h2>
            <p class="content-step">当サービスは借入ではないため、信用情報機関へ照会や保証人も全く必要ございません。<br>
                また取引先に請求書売却の通知が行くことも御座いませんので<br class="pc-b">
                どなたでもご安心にご利用いただけます。</p>
            <div class="list-step">
                <div class="sub">
                    <div class="title">
                        <div><h3 class="tao">その１</h3>
                            最短即日での支払いも可能</div>
                    </div>
                    <div class="des">
                        <p class="img"> <img src="{{ template('images/step-03.png') }}" alt="送金する男性"></p>
                        <p class="text">
                            お申し込み後、必要な書類などが揃いスムーズに進んだ場合は、業界最速級の最短30分での審査も可能となります。また常に専属スタッフが待機しておりますので、スピーディな対応を心がけております。
                        </p>
                    </div>
                </div>
                <div class="sub">
                    <div class="title">
                        <div><h3 class="tao">その２</h3>
                            業界最安の手数料率を実現</div>
                    </div>
                    <div class="des">
                        <p class="img"> <img src="{{ template('images/step-02.png') }}" alt="通帳を見て驚いてる男性"></p>
                        <p class="text">弊社では業界最安水準での手数料でファクタリングサービスを行っております。他社でご利用中のファクタリングサービスの手数料が高い場合は、当社にお見積り下さい。
                        </p>
                    </div>
                </div>
                <div class="sub">
                    <div class="title">
                        <div><h3 class="tao">その３</h3>
                            お申し込みは全てWEB完結</div>
                    </div>
                    <div class="des">
                        <p class="img"> <img src="{{ template('images/step-01.png') }}" alt="PCからアップロードしている男性"></p>
                        <p class="text">
                            お申し込みから契約まで全て当サイトからオンラインで完結可能になります。来店していただく必要もございませんので、スマホ１つでいつでも好きなタイミングで手続きすることができます。</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="section__cloud">
        <div class="container">
            <h2 class="title-public">PayTech -ペイテック-<span class="black">では</span><br>クラウドサイン<span class="black">を<br
                        class="sp-b">導入しております</span></h2>
            <div class="img">
                <img src="{{ template('images/cloudsign_logo.png') }}" alt="PayTech -ペイテック-ではクラウドサインを導入しております">
            </div>
            <div class="content-cloud">クラウドサインとは、電子契約や<br class="sp-b">電子署名のためのクラウドベースの<br class="sp-b">サービスになります。<br>
                従来の紙での契約や署名手続きを全てデジタル化し、<br class="sp-b">オンライン上で簡単かつ効率的に行うことができます。</div>
            <p class="back-to-top">
                <a href="https://www.cloudsign.jp/" target="_blank">詳しくはこちら</a>
            </p>
        </div>
    </div>
    <div class="section__carodi">
        <div class="container">
            <h2 class="title-public">ご利用の流れ</h2>
            <div class="list-carodi">
                <div class="sub">
                    <p class="title">01.お申し込み</p>
                    <p class="des">当サイトのお申し込みフォームから、お客様情報と請求書の画像、もしくはPDFデータを送付の上、お申し込み下さい。</p>
                    <p class="img"> <img src="{{ template('images/carodi-01.png') }}" alt="スマホを操作する人"></p>
                </div>
                <div class="sub">
                    <p class="title">02.現金化</p>
                    <p class="des">お申し込み内容確認、審査を行い、審査結果をご連絡後問題が無ければ、最短90分でお客様の口座へお振込みします</p>
                    <p class="img"> <img src="{{ template('images/carodi-02.png') }}" alt="通帳を見て喜んでいる男性"></p>
                </div>
                <div class="sub">
                    <p class="title">03.弊社へお振込み</p>
                    <p class="des">ご利用後、取引先から売掛金を回収頂けましたら、支払い期日までに、弊社指定の口座へお振込ください。</p>
                    <p class="img"> <img src="{{ template('images/carodi-03.png') }}" alt="送金する男性と受け取る女性"></p>
                </div>
            </div>
            <div class="title-carodi">必要書類</div>
            <p class="content-saw">お申し込みの事前にご準備いただけるとスムーズに取引する事ができます。</p>
            <div class="list-sawe">
                <ul>
                    <li>身分証明書（顔写真が映った運転免許，パスポート，マイナンバーカードなど）</li>
                    <li>入金出金が確認できる通帳コピー（直近3ヶ月分，表紙もお付けください）</li>
                    <li>請求書・注文書の画像データ、もしくはPDFデータ</li>
                    <li>仕事内容がわかる成因証書（契約書，発注書，見積書など）</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="section__yau">
        <div class="container">
            <div class="title-yaw">PayTech -ペイテック-<br class="sp-b">のサービスなら<br>
                面倒な手続き一切無し！<br>
                最短30分で審査完了！</div>
            <div class="list-btn-low">
                <div class="sub">
                    <p class="img"><img src="{{ template('images/icon-ls-01.png') }}" alt="お申し込みフォームはこちら"></p>
                    <p class="title">日本全国24時間受付中</p>
                    <p class="btn-ls"><a href="{{ route(lp().'contact') }}" class="btn">お申し込みフォームはこちら</a></p>
                </div>
                <div class="sub">
                    <p class="img"><img src="{{ template('images/icon-ls-02.png') }}" alt="計算シミュレーターはこちら"></p>
                    <p class="title">買取金額と概算手数料を知りたい方</p>
                    <p class="btn-ls"><a href="{{ route(lp().'home') . '#quick' }}" class="btn">計算シミュレーターはこちら</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="section__member">
        <div class="container">
            <div class="member-after">
                <h2 class="title-public">お客様の声</h2>
                <div class="list-member">
                    <div class="sub">
                        <div class="info">
                            <div class="avt"><img src="{{ template('images/avt-02.png') }}" alt="大阪府 30代のケース"></div>
                            <div class="name">大阪府 30代のケース<span>手数料：6％　<br class="sp-b">資金調達金額：約370万円</span></div>
                        </div>
                        <div class="des">
                            予定してた売掛金の回収が遅れ、支払いが滞り悩んでいたのですがペイテックさんに相談したら、次の日には資金調達することができました。請求書などの書類も簡単に提出することができ本当に便利で、こんなに早く解決できたことに驚きです。スタッフの方のやり取りも丁寧で安心して取引出来ました。
                        </div>
                    </div>
                    <div class="sub">
                        <div class="info">
                            <div class="avt"><img src="{{ template('images/avt-01.png') }}" alt="東京都 40代のケース"></div>
                            <div class="name">東京都 40代のケース<span>手数料：3％　<br class="sp-b">資金調達金額：約840万円</span></div>
                        </div>
                        <div class="des">
                            他社のファクタリング会社を利用していた時、手数料が高く正直困ってました。ネットで調べた所、ペイテックさんのファクタリングサービスが使いやすそうだったので、今回お願いしました。査定して頂いたところ、手数料も安く資金面での負担も減ったので大変助かりました。
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id="faq" class="section">
        <h2 class="title-public">よくあるご質問</h2>
        <div class="faqs fadeup" data-aos="show">
            <div class="faq">
                <div class="question active">申込金額に上限、限度額はありますか？</div>
                <div class="answer active">売掛先の状況に応じて変わりますが、原則10万～最高で5000万円までの金額となっています。</div>
            </div>
            <div class="faq">
                <div class="question">売掛先の企業に知られずに利用したいのですが可能でしょうか？</div>
                <div class="answer">二社間契約のファクタリング方法であれば、取引先や銀行に知られずに手続きすることが可能になります。</div>
            </div>
            <div class="faq">
                <div class="question">銀行の融資や審査に落ちてしまったのですが利用できますか？</div>
                <div class="answer">ファクタリングサービスは融資と違い売掛金の売買契約になりますので問題なくご契約することができます。</div>
            </div>
            <div class="faq">
                <div class="question">他社のファクタリング業者と契約をしたまま利用することは可能ですか？</div>
                <div class="answer">未利用の売掛債権がございましたら、平行して当社をご利用することもできます。</div>
            </div>
        </div>

    </div>

    <div class="section__info">
        <div class="container">
            <h2 class="title-public">会社概要</h2>
            <div class="list-info">
                <div class="sub">
                    <div class="name">サイト名</div>
                    <div class="des">PayTech（ペイテック）</div>
                </div>
                <div class="sub">
                    <div class="name">運営会社</div>
                    <div class="des">株式会社Realize</div>
                </div>
                <div class="sub">
                    <div class="name">所在地</div>
                    <div class="des">東京都台東区上野六丁目8番19号</div>
                </div>
                <div class="sub">
                    <div class="name">電話番号</div>
                    <div class="des"><a href="tel:03-5830-6464">03-5830-6464</a></div>
                </div>
                <div class="sub">
                    <div class="name">営業時間</div>
                    <div class="des">9：00〜18：00</div>
                </div>
                <div class="sub">
                    <div class="name">定休日</div>
                    <div class="des">土日・祝日</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section__yau">
        <div class="container">
            <div class="title-yaw">PayTech -ペイテック-<br class="sp-b">のサービスなら<br>
                面倒な手続き一切無し！<br>
                最短30分で審査完了！</div>
            <div class="list-btn-low">
                <div class="sub">
                    <p class="img"><img src="{{ template('images/icon-ls-01.png') }}" alt="お申し込みフォームはこちら"></p>
                    <p class="title">日本全国24時間受付中</p>
                    <p class="btn-ls"><a href="{{ route(lp().'contact') }}" class="btn">お申し込みフォームはこちら</a></p>
                </div>
                <div class="sub">
                    <p class="img"><img src="{{ template('images/icon-ls-02.png') }}" alt="計算シミュレーターはこちら"></p>
                    <p class="title">買取金額と概算手数料を知りたい方</p>
                    <p class="btn-ls"><a href="{{ route(lp().'home') . '#quick' }}" class="btn">計算シミュレーターはこちら</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('footer')

{{-- <?php if(isNotTestSpeed()):?> --}}
<link
    href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&family=Noto+Sans+JP:wght@300;400;500;700;900&display=swap"
    rel="stylesheet">
{{-- <?php endif;?> --}}
<script src="{{ template('libs/jquery-3.6.1.min.js') }}"></script>
<script src="{{ template('libs/aos/aos.js') }}"></script>
<script src="{{ template('js/script.js') }}"></script>
<script src="{{ template('libs/jquery.validate.min.js') }}"></script>
<script src="{{ template('libs/jquery.validate.additional-methods.js') }}"></script>
<script src="{{ template('libs/multi-form.js') }}"></script>
<script>
const pref_city_url = "{{ template('js/pref_city.json') }}";
</script>
<script src="{{ template('js/step.js?v4') }}"></script>
{{-- <?php 
    function isNotTestSpeed()
    {
    // Không có HTTP_USER_AGENT hoặc HTTP_USER_AGENT có chứa Lighthouse thì xác định là đang test
        if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Lighthouse') !== false) {
            return false;
        }

        return true;
    }
?> --}}
@endpush