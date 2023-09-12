ホームページからお申し込みがありました。<br>
お申し込み内容は以下のとおりです。<br>
<br>
━━━　送信内容　━━━<br>
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