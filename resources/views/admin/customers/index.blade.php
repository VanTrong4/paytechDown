@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12  pb-2 text-right">
        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary btn-sm">新規追加</a>
        <a href="{{ route('admin.customers.export') }}" class="btn btn-success btn-sm ml-1">CSVエクスポート</a>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <form action="{{ route('admin.customers.index') }}">
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
        <h3 class="card-title">顧客管理一覧</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-sm table-bordered">
            <thead>
              <tr>
                <th class="action"></th>
                <th class="action"></th>
                <th class="text-center info info-customer info-lp">登録元サイト</th>
                <th class="text-center info info-customer">登録日</th>
                <th class="text-center info info-customer">名前</th>
                <th class="text-center info info-customer">メールアドレス</th>
                <th class="text-center info info-customer">携帯番号</th>
              </tr>
            </thead>
            <tbody>
              @foreach($customers as $key => $customer)
              <tr class="tr-color-{{ $customer->lastApplication?$customer->lastApplication->status:'' }}">
                <td class="action">
                  <a href="{{ route('admin.customers.detail', $customer) }}" class="btn btn-block btn-success btn-sm" href="">
                    詳細
                  </a>
                </td>
                <td class="action">
                  <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-block btn-primary btn-sm" href="">
                    <i class="far fa-edit"></i> 編集
                  </a>
                </td>
                <td class="created_at">{{ strtoupper($customer->prefix?:"top") }}</td>
                <td class="created_at">{{ $customer->register_date->format('Y年m月d日') }}</td>
                <td class="name">{{ $customer->fullname }}</td>
                <td class="email">{{ $customer->email }}</td>
                <td class="phonenumber">{{ $customer->phonenumber }}</td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card-body -->

      @include('components.pagination', ['items'=>$customers])

    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection