@extends('layouts.master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12  pb-2 text-right">
        <a href="{{ route('admin.applications.export') }}" class="btn btn-success btn-sm ml-1">CSVエクスポート</a>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <form action="{{ route('admin.applications.index') }}">
          <div class="form-inline mb-3">
            <div class="input-group">
              <input class="form-control" value="{{ request()->input('keyword') }}" name="keyword" type="search" placeholder="検索" aria-label="検索">
              <div class="input-group-append">
                <button class="btn btn-primary">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">お申込み内容一覧</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        @include('applications.list', ['applications' => $applications])
      </div>
      <!-- /.card-body -->

      @include('components.pagination', ['items'=>$applications])
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection