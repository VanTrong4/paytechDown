@extends('layouts.master')


@section('content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">ログイン情報管理</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body ">
        <form id="customers-form" method="POST" action="{{ route('admin.profile.update') }}">
          @csrf
          @method('PUT')
          <table class="table table-apply">
            <tbody>
              <tr>
                <th>
                  <label for="email" class="ttl-group">
                    <span class="required">必須</span>メールアドレス
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="form-control  @error('email') is-invalid @enderror" required placeholder="{{ '例：info@'.request()->getHost(); }}">
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
                  <label for="password" class="ttl-group">
                    パスワード
                  </label>
                </th>
                <td>
                  <div class="form-group">
                    <input type="text" id="password" name="password" value="{{ old('password', $user->hint) }}" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span class=" help-block show" role="alert">
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

          </div>
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