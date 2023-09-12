@extends('layouts.master')


@section('content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">広告マスター</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <form id="user-form" method="POST" action="{{ route('admin.master_ads.update', $masterAd) }}">
          @csrf
          @method('PUT')
          <div class="tab current">
            <table class="table table-apply">
              <tbody>
                <tr>
                  <th>コード</th>
                  <td>
                    <div class="form-group">
                      <input type="text" id="code" name="code" value="{{ old('code', $masterAd->code) }}" class="form-control @error('code') is-invalid @enderror" required>
                      @error('code')
                      <span class="help-block show" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>広告名</th>
                  <td>
                    <div class="form-group">
                      <input type="text" id="name" name="name" value="{{ old('name', $masterAd->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                      @error('name')
                      <span class="help-block show" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </td>
                </tr>
                <tr>
                  <th>備考</th>
                  <td>
                    <div class="form-group">
                      <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control  @error('remarks') is-invalid @enderror">{{ old('remarks', $masterAd->remarks) }}</textarea>
                      @error('remarks')
                      <span class="help-block show" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="form-action">
            <button type="submit" name="action" value="send" class="btn btn-primary">
              <span>送信する</span>
            </button>
            <a class="btn btn-danger btn-delete ml-1" data-message="{{ __('Are you sure you want to delete ') }}" data-form="#delete_{{ $masterAd->id }}">
              <i class="fa fa-trash"></i> 削除
            </a>
          </div>
        </form>
        <form id="delete_{{$masterAd->id}}" style="display:none" method="POST" action="{{route('admin.master_ads.destroy',['masterAd'=>$masterAd])}}">
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
      const confirm = alertify.confirm('【この広告マスター 削除確認】', `この広告マスターを削除します。<br />本当に削除しますか？`, function() {
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