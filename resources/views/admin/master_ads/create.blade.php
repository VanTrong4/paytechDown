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
        <h3 class="card-title">広告マスター</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <form id="user-form" method="POST" action="{{ route('admin.master_ads.store') }}">
          @csrf
          <div class="tab current">
            <table class="table table-apply">
              <tbody>
                <tr>
                  <th>コード</th>
                  <td>
                    <div class="form-group">
                      <input type="text" id="code" name="code" value="{{ old('code') }}" class="form-control @error('code') is-invalid @enderror" required>
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
                      <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
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
                      <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control  @error('remarks') is-invalid @enderror">{{ old('remarks') }}</textarea>
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
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection