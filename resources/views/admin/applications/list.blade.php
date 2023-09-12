<div class="table-responsive">
  <table class="table table-sm table-bordered">
    <thead>
      <tr>
        <th colspan="3"></th>
        <th class="text-center info info-customer" colspan="8">お客様の情報入力</th>
        <th class="text-center info info-live" colspan="3">売掛先企業の情報入力 </th>
        <th class="text-center info info-work" colspan="12">勤務先の情報</th>
      </tr>
      <tr>
        <th class="action action-status">ステータス</th>
        <th class="action">写真確認</th>
        <th class="action">詳細</th>
        <th class="info info-customer info-lp">登録元サイト</th>
        <th class="info info-customer">お申込み日</th>
        <th class="info info-customer">御社名</th>
        <th class="info info-customer">ご担当者名</th>
        <th class="info info-customer">ご連絡先電話番号</th>
        <th class="info info-customer">メールアドレス</th>
        <th class="info info-customer">ご住所</th>
        <th class="info info-customer">買取希望の金額</th>

        <th class="info info-live">売掛先の企業名</th>
        <th class="info info-live">ご住所</th>
        <th class="info info-live">その他情報</th>

        <th class="info info-work">売掛先企業名</th>
        <th class="info info-work">売掛先企業の本社所在地</th>
        <th class="info info-work">売掛先の企業規模</th>
        <th class="info info-work">売掛先の資本金</th>
        <th class="info info-work">売掛先の業歴</th>
        <th class="info info-work">売掛先とのお取引回数</th>
        <th class="info info-work">売掛先との契約書の有無</th>
        <th class="info info-work">資金調達QUICKの利用回数</th>
        <th class="info info-work">売掛先へのご請求金額</th>
        <th class="info info-work">概算の手数料</th>
        <th class="info info-work">資金調達成功率</th>
        <th class="info info-work">資金調達可能額</th>
      </tr>
    </thead>
    <tbody>
      @foreach($applications as $key => $application)
      <tr class="tr-color-{{ $application->status }}">
        <td class="action application-status">
          <span class="status status-{{ $application->status }}"></span>
          <select name="status" class="form-control form-control-sm" data-id="{{ $application->id }}" data-old="{{ $application->status }}">
            @foreach(list_status() as $status)
            <option value="{{ $status }}" {{ $status==$application->status?'selected':'' }}>{{ application_status_admin($status) }}</option>
            @endforeach
          </select>
        </td>
        <td class="action">
          <button class="btn btn-sm btn-block btn-default btn-pdf-img" data-toggle="modal" data-target="#preview-image-modal" data-id="{{ $application->id }}">
            <i class="far fa-image"></i> 写真
          </button>
          <div class="d-none">
            <p>身分証明書（前面）</p>
            @if($application->photo_id_1)
            <div class="img-download-wrap">
              <img loading="lazy" src="{{ asset('files/contact/'.$application->photo_id_1) }}" alt="">
              <a href="{{ asset('files/contact/'.$application->photo_id_1) }}" download>
                <i class="fas fa-download"></i> ダウンロードする
              </a>
            </div>
            @endif

            <hr>
            <p>身分証明書（裏面）</p>
            @if($application->photo_id_2)
            <div class="img-download-wrap">
              <img loading="lazy" src="{{ asset('files/contact/'.$application->photo_id_2) }}" alt="">
              <a href="{{ asset('files/contact/'.$application->photo_id_2) }}" download>
                <i class="fas fa-download"></i> ダウンロードする
              </a>
            </div>
            @endif
            <hr>
            <p>売掛先の請求書データ</p>
            @if($application->photo_bill)
            <div class="img-download-wrap">
              <img loading="lazy" src="{{ asset('files/contact/'.$application->photo_bill) }}" alt="">
              <a href="{{ asset('files/contact/'.$application->photo_bill) }}" download>
                <i class="fas fa-download"></i> ダウンロードする
              </a>
            </div>
            @endif
            <hr>
            <p>その他の画像</p>
            @if($application->photo_other)
            <div class="img-download-wrap">
              <img loading="lazy" src="{{ asset('storage/profile/'.$application->photo_other) }}" alt="">
              <a href="{{ asset('storage/profile/'.$application->photo_other) }}" download>
                <i class="fas fa-download"></i> ダウンロードする
              </a>
            </div>
            @endif
            <p>その他の画像①</p>
            @if($application->photo_other_1)
            <div class="img-download-wrap">
              <img loading="lazy" src="{{ asset('storage/profile/'.$application->photo_other_1) }}" alt="">
              <a href="{{ asset('storage/profile/'.$application->photo_other_1) }}" download>
                <i class="fas fa-download"></i> ダウンロードする
              </a>
            </div>
            @endif
            <p>その他の画像②</p>
            @if($application->photo_other_2)
            <div class="img-download-wrap">
              <img loading="lazy" src="{{ asset('storage/profile/'.$application->photo_other_2) }}" alt="">
              <a href="{{ asset('storage/profile/'.$application->photo_other_2) }}" download>
                <i class="fas fa-download"></i> ダウンロードする
              </a>
            </div>
            @endif
            <p>その他の画像③</p>
            @if($application->photo_other_3)
            <div class="img-download-wrap">
              <img loading="lazy" src="{{ asset('storage/profile/'.$application->photo_other_3) }}" alt="">
              <a href="{{ asset('storage/profile/'.$application->photo_other_3) }}" download>
                <i class="fas fa-download"></i> ダウンロードする
              </a>
            </div>
            @endif
          </div>
        </td>
        <td class="action">
          <a href="{{ route('admin.applications.edit', $application ) }}" class="btn btn-block btn-sm btn-default">
            <i class="far fa-edit"></i> 詳細
          </a>
        </td>
        <td>{{ strtoupper($application->prefix?:"top") }}</td>
        <td class="application_at info info-customer">{{ $application->created_at->format('Y年m月d日') }}</td>
        <td class="info info-customer">{{ $application->company }}</td>
        <td class="info info-customer">{{ $application->fullname }}</td>
        <td class="info info-customer">{{ $application->phonenumber }}</td>
        <td class="info info-customer">{{ $application->email }}</td>
        <td class="info info-customer">{{ $application->address }}</td>
        <td class="info info-customer">{{ $application->amount }}万円</td>

        <td class="info info-live">{{ $application->company_office }}</td>
        <td class="info info-live">{{ $application->company_address }}</td>
        <td class="info info-live">{{ $application->company_other }}</td>


        <td class="company_apartment_room info info-work">{{ $application->company_name }}</td>
        <td class="company_phonenumber info info-work">{{ $application->prefect }}{{ $application->city }}</td>
        <td class="bank_name info info-work">{{ $application->company_size }}</td>
        <td class="branch_name info info-work">{{ $application->receivable_capital }}</td>
        <td class="branch_number info info-work">{{ $application->business_history }}</td>
        <td class="account_type info info-work">{{ $application->number_of_transactions }}</td>
        <td class="account_number info info-work">{{ $application->has_contract }}</td>
        <td class="account_name_kana info info-work">{{ $application->quick_was_used }}</td>
        <td class="account_name_kana info info-work">{{ $application->billing }}%〜</td>
        <td class="account_name_kana info info-work">{{ $application->percent }}%〜</td>
        <td class="account_name_kana info info-work">{{ $application->fundraising_price }}万円～</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@push('footer')

<!-- Modal -->
<div id="preview-image-modal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div id="preview-image"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('閉じる'); ?></button>
      </div>
    </div>

  </div>
</div>
<script>
  $(document).ready(function() {
    $("[name='status']").change(function() {
      const selecter = $(this);
      const status = $(this).val();
      const id = $(this).data('id');

      const statusSelect = $(this).prev('.status');
      const statusTr = $(this).closest('tr');
      const selectOldVal = selecter.data('old');
      const selectOldClass = statusSelect.attr('class');
      const trOldClass = statusTr.attr('class');
      statusSelect.removeAttr('class');
      statusTr.removeAttr('class')
      $.ajax({
        type: 'PUT',
        url: `{{ route("admin.applications.update_status") }}`,
        data: {
          status: status,
          id: id
        },
        success: function(res) {
          if (res.status === false) {
            selecter.data('old', selectOldVal);
            selecter.val(selectOldVal);
            statusSelect.addClass(selectOldClass);
            statusTr.addClass(trOldClass);
            alert(res.msg)
          } else {
            selecter.data('old', status);
            statusSelect.addClass(`status status-${status} `);
            statusTr.addClass(`tr-color-${status} `);
          }
        }
      });
    });

    $(".btn-delete").click(function(event) {
      const formEle = $(this).data('form');
      const confirm = alertify.confirm('【このお申込み内容 削除確認】', `このお申込み内容を削除します。<br />本当に削除しますか？`, function() {
        $(formEle).submit();
      }, function() {
        this.close();
      }).set('labels', {
        ok: 'はい',
        cancel: 'キャンセル'
      });
    });

    $('#preview-image-modal').on('shown.bs.modal', function(event) {
      const button = $(event.relatedTarget);
      $("#preview-image").html($(button).next('div').html());
    });
    $('#preview-image-modal').on('hide.bs.modal', function(event) {
      $("#preview-image").html("");
    });
  })
</script>
@endpush