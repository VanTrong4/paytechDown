<?php

function canonical()
{
    $current = app('url')->current();
    $prefix = prefix();
    if($prefix){
        $current = str_replace('/'.$prefix,'',$current);
    };
    return $current;
}

function prefix()
{
    try{
        $prefix = "";
        $route = app('request')->route();
        if($route){
            $prefix = $route->getPrefix();
            return $prefix !== "admin" ? $prefix : "";
        }
    } catch(Exception $e){
        return '';
    }
}

function lp()
{
    if($prefix = prefix())
        return $prefix . '.';
    return '';    
}

function template($file)
{
    return asset(template_path().$file);
}
function template_path()
{
    return 'templates/' . (prefix() ?: 'top/');   
}

function checkValidations(): bool
{
  if (!isAllowPostMethod())  exit('Contact not allow Method');
  if (!isAllowRefrer()) exit('Contact not allow Refrer');
  if (!checkJsInput()) exit('Contact not allow Input');
  if (!checkFields()) exit('Contact not allow Field');

  return true;
}
function checkJsInput()
{
  return isset($_POST['email'])
    && $_POST['email']
    && isset($_POST['_confirm'])
    && $_POST['_confirm'] == 'form-has-confirm';
}
function checkFields()
{
  $fields = [
    'address',
    'phonenumber',
    'email',
    'company',
    'fullname',
    'amount',
    'format',
    'company_office',
    'company_address',
    'company_other',
    'company_phone_my',
  ];
  foreach ($fields as $field) {
    if (!isset($_POST[$field]) || !$_POST[$field]) return false;
  }
  $photos = [
    'photo_id_1',
    'photo_id_2',
    'photo_bill',
    'photo_item',
  ];
  foreach ($photos as $photo) {
    if (!isset($_FILES[$photo])) return false;
  }
  return true;
}

function isAllowPostMethod()
{
  return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function isAllowRefrer()
{
  return isset($_SERVER['HTTP_REFERER']);
}


function list_prefect()
{
  return ["北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県", "茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県", "新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県", "岐阜県", "静岡県", "愛知県", "三重県", "滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県", "鳥取県", "島根県", "岡山県", "広島県", "山口県", "徳島県", "香川県", "愛媛県", "高知県", "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"];
}
function list_status()
{
  return ['new', 'review', 'contract', 'waiting_for_payment', 'no_results', 'send_off', 'no_line', 'additional_resources', 'complete', 'refuse', 'payment', 'unshipped'];
}
function application_status_admin($status)
{
  switch ($status) {
    case 'new':
      return "新規";
    case 'review':
      return "審査中";
    case 'contract':
      return "契約書";
    case 'waiting_for_payment':
      return "入金待ち";
    case  'no_results':
      return "結果出ず";
    case 'send_off':
      return "見送り";
    case 'no_line':
      return "LINEなし";
    case  'additional_resources':
      return "追加資料";
    case 'complete':
      return "現客";
    case 'refuse':
      return "当社断り";
    case 'payment':
      return "決済";
    case 'unshipped':
      return "未発送";
    default:
      return $status;
  }
}
function application_status_customer($status)
{
  switch ($status) {
    case 'new':
      return "新規";
    case 'review':
      return "査定中";
    case 'contract':
      return "契約書";
    case 'waiting_for_payment':
      return "入金待ち";
    case  'no_results':
      return "結果出ず";
    case 'send_off':
      return "見送り";
    case 'no_line':
      return "LINE登録";
    case  'additional_resources':
      return "追加資料";
    case 'complete':
      return "完了済み";
    case 'refuse':
      return "買取不可";
    case 'payment':
      return "完了済み";
    case 'unshipped':
      return "未発送";
    default:
      return $status;
  }
}


// MAIL

function getCustomerSubject()
{
  return config('lp.' . (prefix() ?: 'top') . '.customer_subject');
}

function getAdminSubject()
{
  return config('lp.' . (prefix() ?: 'top') . '.admin_subject');
}

function getAdminEmail()
{
  return config('lp.' . (prefix() ?: 'top') . '.admin_email');
}

function getAdminEmailBcc()
{
  return config('lp.' . (prefix() ?: 'top') . '.admin_email_bcc');
}