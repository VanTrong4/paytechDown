@extends('layouts.master')


@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item "><a href="{{ route('admin.customers.index') }}">顧客管理一覧</a></li>
          <li class="breadcrumb-item active">新規追加</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12 text-right">


      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">顧客管理一覧</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <form id="customers-form" method="POST" action="{{ route('admin.customers.store') }}">
          @csrf

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
                    <input type="text" id="fullname" name="fullname" value="{{ old('fullname') }}" class="form-control @error('fullname') is-invalid @enderror" required>
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
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control  @error('email') is-invalid @enderror" required placeholder="{{ '例：info@'.request()->getHost(); }}">
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
                    <input type="tel" id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}" class="form-control @error('phonenumber') is-invalid @enderror" required placeholder="例）0120355334">
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
                    <textarea id="note" name="note" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>

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
              <span>送信する</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection