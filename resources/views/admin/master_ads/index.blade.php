@extends('layouts.master')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12  pb-2 text-right">
        <a href="{{ route('admin.master_ads.print') }}" class="btn btn-info btn-sm ml-1 btn-pdf-print">印刷する</a>
        <a href="{{ route('admin.master_ads.export') }}" class="btn btn-success btn-sm ml-1">CSVエクスポート</a>
        <a href="{{ route('admin.master_ads.create') }}" class="btn btn-primary btn-sm">新規追加</a>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <form action="{{ route('admin.master_ads.index') }}">
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
        <h3 class="card-title">広告マスター</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-sm table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center th-yellow" style="width: 100px">No.</th>
                <th class="text-center th-yellow" style="width: 200px">コード</th>
                <th class="text-center th-yellow" style="width: 300px">広告名</th>
                <th class="text-center th-yellow">備考</th>
                <th class="action" style="width: 100px"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($items as $key => $item)
              <tr>
                <td class="text-right">{{ $key+1 }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->remarks }}</td>
                <td class="action">
                  <a href="{{ route('admin.master_ads.edit', $item) }}" class="btn btn-block btn-primary btn-sm" href="">
                    <i class="far fa-edit"></i> 編集
                  </a>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card-body -->

      @include('components.pagination')
    </div>
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- Modal -->
<div id="application-modal" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span id="popup_member_name"></span> - お申込み内容一覧</h4>
      </div>
      <div class="modal-body">
        <div id="applications"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('閉じる'); ?></button>
      </div>
    </div>

  </div>
</div>
@endsection
@push('footer')
<script>
  jQuery(function($) {

    $('#application-modal').on('shown.bs.modal', function(event) {
      const button = $(event.relatedTarget);
      const memberId = button.data('member_id');
      const memberName = button.data('member_name');
      $("#popup_member_name").text(memberName);
      $.ajax({
        url: `/admin/applications/${memberId}/member`,
        success: function(res) {
          $("#applications").html(res);
        }
      })
    });
    $('#application-modal').on('hide.bs.modal', function(event) {
      $("#popup_member_name").text('-------');
      $("#applications").html('')
    });

    $(".btn-pdf-print").click(function(e) {
      e.preventDefault();
      const id = $(this).data('id');
      $.ajax({
        url: `{{ route('admin.master_ads.print') }}?page={{request()->page}}`,
        success: function(res) {
          var mywindow = window.open("", "");
          mywindow.document.write(res);;
          mywindow.document.close(); // necessary for IE >= 10
          mywindow.focus(); // necessary for IE >= 10
          mywindow.print();
          mywindow.close();
          return true;
        }
      })
      return true;
    });
  })
</script>
@endpush