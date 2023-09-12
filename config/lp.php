<?php

return [

  'lp_pages'  =>   env('LP_PAGES', ''),
  'top' => [
    'admin_email' =>  env('TOP_ADMIN_EMAIL', 'ps2210001@gmail.com'),
    'admin_email_bcc' =>  env('TOP_ADMIN_EMAIL_BCC', false),
    'admin_subject' =>  env('TOP_ADMIN_SUBJECT', '［PayTech（ペイテック）］ホームページよりお申し込みがありました'),
    'customer_subject' =>  env('TOP_CUSTOMER_SUBJECT', '【PayTech（ペイテック）】お申し込みありがとうございます'),
  ],
  'lp' => [
    'admin_email' =>  env('LP_ADMIN_EMAIL', 'ps2210001@gmail.com'),
    'admin_email_bcc' =>  env('LP_ADMIN_EMAIL_BCC', false),
    'admin_subject' =>  env('LP_ADMIN_SUBJECT', '［PayTech（ペイテック）］ホームページよりお申し込みがありました(LP)'),
    'customer_subject' =>  env('LP_CUSTOMER_SUBJECT', '【PayTech（ペイテック）】お申し込みありがとうございます'),
  ],

];
