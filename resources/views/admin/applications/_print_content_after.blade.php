<p>
  【買主】<br>
  屋号：即BUY(ソクバイ)<br>
  住所：愛知県名古屋市中村区名駅４丁目24番5号　第2森ビル401<br>
  代表者：金富文夫
</p>
<div class="pagebreak"></div>
<p>
  別紙
</p>
<table>
  <tr>
    <td>
      本件物品 (第 1 条)
    </td>
    <td>
      品名: {{ $application->contract_purchased_product?:"＿＿" }}<br>
      数量: {{ $application->contract_product_qty?:"＿＿" }}枚
    </td>
  </tr>
  <tr>
    <td>
      売買代金 (第 2 条)
    </td>
    <td>
      単価: {{ $application->contract_purchased_amount?:"＿＿" }} 円<br>
      売買代金総額: {{ $application->contract_product_price_total?:"＿＿" }} 円
    </td>
  </tr>
  <tr>
    <td>
      納入条件(第 3 条)
    </td>
    <td>
      納入場所及び方法 買主の指定する住所宛に郵送<br>
      納入日:<br>
      ①代金先払いの場合:契約締結日より{{ $application->contract_payment_shipping_day?:"＿＿" }}週間後の日必着にて発送<br>
      ②代金後払いの場合:契約締結日より{{ $application->contract_deferred_payment_shipping_day?:"＿＿" }}週間後の日必着にて発送
    </td>
  </tr>
  <tr>
    <td>
      売買代金の弁済期(第 8 条)
    </td>
    <td>
      ①代金先払いの場合：本売買契約成立後 1 営業日以内に、売主指定<br>
      の金融機関の口座宛に振り込む方法により支払う。<br>
      ②代金後払いの場合：検収合格後 3 営業日以内に、売主指定の金融<br>
      機関の口座宛に振り込む方 法により支払う。
    </td>
  </tr>
</table>