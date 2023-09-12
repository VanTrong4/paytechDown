<div class="table-responsive">
  <table class="table table-sm table-bordered table-hover">
    <thead>
      <tr>
        <th class="text-center info info-live" colspan="8">お住まいの情報 </th>
        <th class="text-center info info-work" colspan="6">勤務先の情報</th>
        <th class="text-center info info-account" colspan="6">口座番号</th>
      </tr>
      <tr>
        <th class="info info-live">お申込み日</th>
        <th class="info info-live">ご希望の連絡方法</th>
        <th class="info info-live">LINE ID</th>
        <th class="info info-live">郵便番号</th>
        <th class="info info-live">都道府県</th>
        <th class="info info-live">市区町村</th>
        <th class="info info-live">番地</th>
        <th class="info info-live">マンション名・部屋番号</th>
        <th class="info info-work">郵便番号</th>
        <th class="info info-work">都道府県</th>
        <th class="info info-work">市区町村</th>
        <th class="info info-work">番地</th>
        <th class="info info-work">マンション名・部屋番号</th>
        <th class="info info-work">電話番号</th>
        <th class="info info-account">銀行名</th>
        <th class="info info-account">支店名</th>
        <th class="info info-account">支店番号</th>
        <th class="info info-account">口座の種類</th>
        <th class="info info-account">口座番号</th>
        <th class="info info-account">口座名義(カナ)</th>
      </tr>
    </thead>
    <tbody>
      @foreach($applications as $key => $application)
      <tr>
        <td class="application_at">{{ $application->created_at->format('Y年m月d日') }}</td>
        <td class="preferred_contact">{{ $application->preferred_contact }}</td>
        <td class="line_id">{{ $application->line_id }}</td>
        <td class="zipcode">〒{{ $application->zipcode1 }}-{{ $application->zipcode2 }}</td>
        <td class="prefect">{{ $application->prefect }}</td>
        <td class="district">{{ $application->district }}</td>
        <td class="address">{{ $application->address }}</td>
        <td class="apartment_room">{{ $application->apartment_room }}</td>
        <td class="company_zipcode">〒{{ $application->company_zipcode1 }}-{{ $application->company_zipcode2 }}</td>
        <td class="company_prefect">{{ $application->company_prefect }}</td>
        <td class="company_district">{{ $application->company_district }}</td>
        <td class="company_address">{{ $application->company_address }}</td>
        <td class="company_apartment_room">{{ $application->company_apartment_room }}</td>
        <td class="company_phonenumber">{{ $application->company_phonenumber }}</td>
        <td class="bank_name">{{ $application->bank_name }}</td>
        <td class="branch_name">{{ $application->branch_name }}</td>
        <td class="branch_number">{{ $application->branch_number }}</td>
        <td class="account_type">{{ $application->account_type }}</td>
        <td class="account_number">{{ $application->account_number }}</td>
        <td class="account_name_kana">{{ $application->account_name_kana }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>