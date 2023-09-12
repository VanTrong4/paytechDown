<!DOCTYPE html>
<html lang="ja" moznomarginboxes mozdisallowselectionprint>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>契約書_{{ $application->user->name }}様＿{{ date('Ymd') }}</title>
  @include('applications._print_css')
</head>

<body>
  @include('applications._print_content_before')
  <p>
    氏名: {{ $application->contract_person?:"＿＿＿＿＿＿" }}
  </p>
  @include('applications._print_content_after')
</body>

</html>