@extends('layouts.master')

@push('head')

<link rel="stylesheet" href="{{ asset('templates/admin/css/print.css') }}">
@endpush
@section('content')

<!-- Main content -->
<section class="content">
  <div class="container-fluid bg-print ">
    <form action="{{ route('admin.applications.contract', $application) }}" method="POST">
      @csrf
      <div id="print-content">

        @include('applications._print_content_before')
        <p>
          氏名: <input type="text" name="contract_person" value="{{ $application->contract_person }}" style="width:300px">
        </p>
        @include('applications._print_content_after')
      </div>
      <div class="action text-center mt-5">
        <button class="btn btn-success" type="submit">契約する</button>
        <button class="btn btn-success btn-pdf-print" type="button">PDFダウンロード</button>

      </div>
    </form>
  </div>
</section>
@endsection

@push('footer')

<script>
  $(document).ready(function() {
    $(".btn-pdf-print").click(function() {
      const id = $(this).data('id');
      $.ajax({
        url: `{{ route('admin.applications.pdf_print', $application) }}`,
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