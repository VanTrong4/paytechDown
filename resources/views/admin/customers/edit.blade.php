@extends('layouts.master')


@section('content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">顧客管理一覧</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body ">
        <form id="customers-form" method="POST" action="{{ route('admin.customers.update', $customer) }}">
          @csrf
          @method('PUT')
          <table class="table table-apply">
            <tbody>
              <tr>
                <th>
                  <label for="name" class="ttl-group">
                    <span class="required">必須</span>名前
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="text" id="fullname" name="fullname" value="{{ old('fullname', $customer->fullname) }}" class="form-control @error('fullname') is-invalid @enderror" required>
                    @error('fullname')
                    <span class="help-block show" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="email" class="ttl-group">
                    <span class="required">必須</span>メールアドレス
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="email" name="email" id="email" value="{{ old('email', $customer->email) }}" class="form-control  @error('email') is-invalid @enderror" required placeholder="{{ '例：info@'.request()->getHost(); }}">
                    @error('email')
                    <span class="help-block show" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="phonenumber" class="ttl-group">
                    <span class="required">必須</span>携帯番号
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="tel" id="phonenumber" name="phonenumber" value="{{ old('phonenumber', $customer->phonenumber) }}" class="form-control @error('phonenumber') is-invalid @enderror" required placeholder="例）0120355334">
                    @error('phonenumber')
                    <span class="help-block show" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </td>
              </tr>
              <tr>
                <th>
                  <label for="note" class="ttl-group">
                    メモ
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <textarea id="note" name="note" class="form-control @error('note') is-invalid @enderror">{{ old('note', $customer->note) }}</textarea>

                    @error('note')
                    <span class="help-block show" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="form-action">
            <button type="submit" name="action" value="send" class="btn btn-primary">
              <span>登録する</span>
            </button>

            <a class="btn btn-danger btn-delete ml-1" data-message="{{ __('Are you sure you want to delete ') }}" data-form="#delete_{{ $customer->id }}">
              <i class="fa fa-trash"></i> 削除
            </a>
          </div>
        </form>
        <form id="delete_{{ $customer->id }}" style="display:none" method="POST" action="{{route('admin.customers.destroy',['customer'=>$customer])}}">
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
    $(".btn-delete").click(function(event) {
      const formEle = $(this).data('form');
      const confirm = alertify.confirm('【この顧客 削除確認】', `この顧客を削除します。<br />本当に削除しますか？`, function() {
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