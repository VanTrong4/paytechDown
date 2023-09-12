@extends('layouts.master')


@section('content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 text-right">


      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">お申込み内容詳細</h3>
      </div>
      <form id="application-form" method="POST" action="{{ route('admin.applications.update', $application) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="referer" value="{{ request()->headers->get('referer') }}">


        <h4>＜査定シミュレーター結果＞</h4>
        <table class="table">
          <tr>
            <th>売掛先企業名</th>
            <td>
              {{ $application->company_name}}
            </td>
          </tr>
          <tr>
            <th>売掛先企業の本社所在地</th>
            <td>
              {{ $application->prefect}}[city]
            </td>
          </tr>
          <tr>
            <th>売掛先の企業規模</th>
            <td>
              {{ $application->company_size}}
            </td>
          </tr>
          <tr>
            <th>売掛先の資本金</th>
            <td>
              {{ $application->receivable_capital}}
            </td>
          </tr>
          <tr>
            <th>売掛先の業歴</th>
            <td>
              {{ $application->business_history}}
            </td>
          </tr>
          <tr>
            <th>売掛先とのお取引回数</th>
            <td>
              {{ $application->number_of_transactions}}
            </td>
          </tr>
          <tr>
            <th>売掛先との契約書の有無</th>
            <td>
              {{ $application->has_contract}}
            </td>
          </tr>
          <tr>
            <th>資金調達QUICKの利用回数</th>
            <td>
              {{ $application->quick_was_used}}
            </td>
          </tr>
          <tr>
            <th>売掛先へのご請求金額</th>
            <td>
              {{ $application->billing}}万円
            </td>
          </tr>
          <tr>
            <th>概算の手数料</th>
            <td>
              {{ $application->percent}}%〜
            </td>
          </tr>
          <tr>
            <th>資金調達成功率</th>
            <td>
              {{ $application->fundraising_percent}}%〜
            </td>
          </tr>
          <tr>
            <th>資金調達可能額</th>
            <td>
              {{ $application->fundraising_price}}万円～
            </td>
          </tr>
        </table>

        <h4>＜お客様の情報入力＞</h4>
        <table class="table">
          <tr>
            <th>御社名</th>
            <td>
              {{$application->company}}
            </td>
          </tr>
          <tr>
            <th>ご担当者名</th>
            <td>
              {{$application->fullname}}
            </td>
          </tr>
          <tr>
            <th>ご連絡先電話番号</th>
            <td>
              {{$application->phonenumber}}
            </td>
          </tr>
          <tr>
            <th>メールアドレス</th>
            <td>
              {{$application->email}}
            </td>
          </tr>
          <tr>
            <th>ご住所</th>
            <td>
              {{$application->address}}
            </td>
          </tr>
          <tr>
            <th>買取希望の金額</th>
            <td>
              {{$application->amount}}万円
            </td>
          </tr>
        </table>
        <h4>＜売掛先企業の情報入力＞</h4>

        <table class="table">
          <tr>
            <th>売掛先の企業名</th>
            <td>{{ $application->company_office}}</td>
          </tr>
          <tr>
            <th>ご住所</th>
            <td>{{ $application->company_address}}</td>
          </tr>
          <tr>
            <th>その他情報</th>
            <td>{{ $application->company_other}}</td>
          </tr>
        </table>
        <h4>必要書類の添付</h4>
        <table class="table table-apply fadein" data-aos="show">
          <tbody>
            <tr>
              <th class="info info-account">買取希望商品</th>
              <td>
                <div class="control">
                  <input type="file" id="photo_wish_item" name="photo_wish_item" accept="image/*">
                </div>
                <div class="img-download-wrap" id="photo_wish_item_preview">
                  @if($application->photo_wish_item)
                  <img src="{{ asset('storage/profile/'.$application->photo_wish_item) }}" alt="">
                  <a href="{{ asset('storage/profile/'.$application->photo_wish_item) }}" download>
                    <i class="fas fa-download"></i> ダウンロードする
                  </a>
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              <th class="info info-account">セルフィー（自画撮り）</th>
              <td>
                <div class="control">
                  <input type="file" id="photo_selfie" name="photo_selfie" accept="image/*">
                </div>
                <div class="img-download-wrap" id="photo_selfie_preview">
                  @if($application->photo_selfie)
                  <img src="{{ asset('storage/profile/'.$application->photo_selfie) }}" alt="">
                  <a href="{{ asset('storage/profile/'.$application->photo_selfie) }}" download>
                    <i class="fas fa-download"></i> ダウンロードする
                  </a>
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              <th class="info info-account">
                運転免許証、または<br>
                顔写真付きの身分証明書
              </th>
              <td>
                <div class="control">
                  <input type="file" id="photo_1" name="photo_1" accept="image/*">
                </div>
                <div class="img-download-wrap" id="photo_1_preview">
                  @if($application->photo_1)
                  <img src="{{ asset('storage/profile/'.$application->photo_1) }}" alt="">
                  <a href="{{ asset('storage/profile/'.$application->photo_1) }}" download>
                    <i class="fas fa-download"></i> ダウンロードする
                  </a>
                  @endif
                </div>

                <p>※裏面</p>
                <div class="control">
                  <input type="file" id="photo_2" name="photo_2" accept="image/*">
                </div>
                <div class="img-download-wrap" id="photo_2_preview">
                  @if($application->photo_2)
                  <img src="{{ asset('storage/profile/'.$application->photo_2) }}" alt="">
                  <a href="{{ asset('storage/profile/'.$application->photo_2) }}" download>
                    <i class="fas fa-download"></i> ダウンロードする
                  </a>
                  @endif
                </div>
                <br>
                <div class="control">
                  <input type="file" id="photo_3" name="photo_3" accept="image/*">
                </div>
                <div class="img-download-wrap" id="photo_3_preview">
                  @if($application->photo_3)
                  <img src="{{ asset('storage/profile/'.$application->photo_3) }}" alt="">
                  <a href="{{ asset('storage/profile/'.$application->photo_3) }}" download>
                    <i class="fas fa-download"></i> ダウンロードする
                  </a>
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              <th class="info info-account">
                保険証
              </th>
              <td>
                <div class="control">
                  <input type="file" id="photo_insurance_card" name="photo_insurance_card" accept="image/*">
                </div>
                <div class="img-download-wrap" id="photo_insurance_card_preview">
                  @if($application->photo_insurance_card)
                  <img src="{{ asset('storage/profile/'.$application->photo_insurance_card) }}" alt="">
                  <a href="{{ asset('storage/profile/'.$application->photo_insurance_card) }}" download>
                    <i class="fas fa-download"></i> ダウンロードする
                  </a>
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              <th class="info info-account">
                その他の画像
              </th>
              <td>
                <div class="control">
                  <input type="file" id="photo_other" name="photo_other" accept="image/*">
                </div>
                <div class="img-download-wrap" id="photo_other_preview">
                  @if($application->photo_other)
                  <img src="{{ asset('storage/profile/'.$application->photo_other) }}" alt="">
                  <a href="{{ asset('storage/profile/'.$application->photo_other) }}" download>
                    <i class="fas fa-download"></i> ダウンロードする
                  </a>
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              <th class="info info-account">
                その他の画像①
              </th>
              <td>
                <div class="control">
                  <input type="file" id="photo_other_1" name="photo_other_1" accept="image/*">
                </div>
                <div class="img-download-wrap" id="photo_other_1_preview">
                  @if($application->photo_other_1)
                  <img src="{{ asset('storage/profile/'.$application->photo_other_1) }}" alt="">
                  <a href="{{ asset('storage/profile/'.$application->photo_other_1) }}" download>
                    <i class="fas fa-download"></i> ダウンロードする
                  </a>
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              <th class="info info-account">
                その他の画像②
              </th>
              <td>
                <div class="control">
                  <input type="file" id="photo_other_2" name="photo_other_2" accept="image/*">
                </div>
                <div class="img-download-wrap" id="photo_other_2_preview">
                  @if($application->photo_other_2)
                  <img src="{{ asset('storage/profile/'.$application->photo_other_2) }}" alt="">
                  <a href="{{ asset('storage/profile/'.$application->photo_other_2) }}" download>
                    <i class="fas fa-download"></i> ダウンロードする
                  </a>
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              <th class="info info-account">
                その他の画像③
              </th>
              <td>
                <div class="control">
                  <input type="file" id="photo_other_3" name="photo_other_3" accept="image/*">
                </div>
                <div class="img-download-wrap" id="photo_other_3_preview">
                  @if($application->photo_other_3)
                  <img src="{{ asset('storage/profile/'.$application->photo_other_3) }}" alt="">
                  <a href="{{ asset('storage/profile/'.$application->photo_other_3) }}" download>
                    <i class="fas fa-download"></i> ダウンロードする
                  </a>
                  @endif
                </div>
              </td>
            </tr>
            <tr>
              <th class="info info-account">
                その他
              </th>
              <td style="white-space: break-spaces;">{{ $application->other }}</td>
            </tr>
          </tbody>
        </table>
        <h4>契約状況</h4>

        <div class="form-title fadein" data-aos="show">＜お住まいの情報＞</div>
        <table class="table table-apply fadein" data-aos="show">
          <tbody>
            <tr>
              <th>ステータス</th>
              <td>
                <div class="input-group">
                  <div class="application-status">
                    <span class="status status-{{ $application->status }}"></span>
                    <select name="status" class="form-control form-control-sm" data-id="{{ $application->id }}">
                      @foreach(list_status() as $status)
                      <option value="{{ $status }}" {{ $status==$application->status?'selected':'' }}>{{ application_status_admin($status) }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <div class="form-action">

          <button type="submit" name="action" value="send" class="btn btn-primary">
            <span>保存する</span>
          </button>
          <a class="btn btn-danger btn-delete ml-1" data-message="{{ __('Are you sure you want to delete ') }}" data-form="#delete_{{ $application->id }}">
            <i class="fa fa-trash"></i> 削除
          </a>
        </div>
      </form>
      <form id="delete_{{$application->id}}" style="display:none" method="POST" action="{{route('admin.applications.destroy',['application'=>$application])}}">
        {{ csrf_field() }}
        @method('DELETE')
      </form>
    </div>
  </div>
  </div>
</section>
@endsection
@push('footer')
<script>
  jQuery(function($) {
    $("[name='status']").change(function() {
      const status = $(this).val();
      const id = $(this).data('id');
      $(this).prev('.status').removeAttr('class').addClass(`status status-${status} `);
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
  })
</script>
@endpush