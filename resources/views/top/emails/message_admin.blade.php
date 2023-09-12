ホームページからお申し込みがありました。<br>
お申し込み内容は以下のとおりです。<br>
<br>
━━━　送信内容　━━━<br>
■買取価格のシミュレート<br>
売掛先企業: {{ $application->company_name }}<br>
売掛先企業の本社所在地: {{ $application->prefect }}[city]<br>
売掛先の企業規模: {{ $application->company_size }}<br>
売掛先の資本金: {{ $application->receivable_capital }}<br>
売掛先の業歴: {{ $application->business_history }}<br>
売掛先とのお取引回数: {{ $application->number_of_transactions }}<br>
売掛先との契約書の有無: {{ $application->has_contract }}<br>
PAYTECH-ペイテック-のご利用回数: {{ $application->quick_was_used }}<br>
売掛先へのご請求金額: {{ $application->billing }}万円<br>
概算手数料: {{ $application->percent }}%〜<br>
資金調達成功率: {{ $application->fundraising_percent }}%〜<br>
資金調達可能額: {{ $application->fundraising_price }}万円～<br>
<br>
■お客様の情報をご入力<br>
お名前: {{ $application->address }}<br>
電話番号: {{ $application->phonenumber }}<br>
メールアドレス: {{ $application->email }}<br>
ご住所: {{ $application->company }}<br>
会社名・屋号名: {{ $application->fullname }}<br>
買取希望金額: {{ $application->amount }}万円<br>
ご希望のファクタリング形式: {{ $application->format }}<br>
<br>
■売掛先の企業様の情報をご入力<br>
売掛先の企業名: {{ $application->company_office }}<br>
売掛先の所在地: {{ $application->company_address }}<br>
その他情報: {{ $application->company_other }}<br>
電話番号: {{ $application->company_phone_my }}<br>
━━━━━━━━━━━━<br>
※本メールはサーバーからの自動返信メールとなっております。<br>