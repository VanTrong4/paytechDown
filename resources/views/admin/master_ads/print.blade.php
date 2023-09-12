<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>広告マスター</title>
  <style>
    @page {
      size: auto;
      margin: 23mm 10mm;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      text-align: left;
      border: 1px solid #8a8a8a;
      padding: 5px 10px;
    }

    th {
      border-bottom: 3px solid #8a8a8a;
    }
  </style>
</head>

<body>

  <table class="table table-sm table-bordered table-hover">
    <thead>
      <tr>
        <th class="text-center th-yellow" style="width: 40px">No.</th>
        <th class="text-center th-yellow" style="width: 150px">コード</th>
        <th class="text-center th-yellow" style="width: 150px">広告名</th>
        <th class="text-center th-yellow">備考</th>
      </tr>
    </thead>
    <tbody>
      @foreach($items as $key => $item)
      <tr>
        <td class="text-right">{{ $key+1 }}</td>
        <td>{{ $item->code }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->remarks }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>