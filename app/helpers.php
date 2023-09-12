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