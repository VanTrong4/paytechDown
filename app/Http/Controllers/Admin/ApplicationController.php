<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helper\XLSXWriterHelper;
use App\Models\Application;
use Carbon\Carbon;

class ApplicationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $keyword = $request->input('keyword');
    $applications = Application::where(function ($query) use ($keyword) {
      if ($keyword) {
        return $query->where('company_name', 'LIKE', '%' . $keyword . '%')
          ->orWhere('prefect', 'LIKE', '%' . $keyword . '%')
          ->orWhere('city', 'LIKE', '%' . $keyword . '%')
          ->orWhere('company_size', 'LIKE', '%' . $keyword . '%')
          ->orWhere('receivable_capital', 'LIKE', '%' . $keyword . '%')
          ->orWhere('business_history', 'LIKE', '%' . $keyword . '%')
          ->orWhere('number_of_transactions', 'LIKE', '%' . $keyword . '%')
          ->orWhere('has_contract', 'LIKE', '%' . $keyword . '%')
          ->orWhere('quick_was_used', 'LIKE', '%' . $keyword . '%')
          ->orWhere('billing', 'LIKE', '%' . $keyword . '%')
          ->orWhere('percent', 'LIKE', '%' . $keyword . '%')
          ->orWhere('fundraising_percent', 'LIKE', '%' . $keyword . '%')
          ->orWhere('fundraising_price', 'LIKE', '%' . $keyword . '%')
          ->orWhere('company', 'LIKE', '%' . $keyword . '%')
          ->orWhere('fullname', 'LIKE', '%' . $keyword . '%')
          ->orWhere('phonenumber', 'LIKE', '%' . $keyword . '%')
          ->orWhere('email', 'LIKE', '%' . $keyword . '%')
          ->orWhere('address', 'LIKE', '%' . $keyword . '%')
          ->orWhere('amount', 'LIKE', '%' . $keyword . '%')
          ->orWhere('company_office', 'LIKE', '%' . $keyword . '%')
          ->orWhere('company_address', 'LIKE', '%' . $keyword . '%')
          ->orWhere('company_other', 'LIKE', '%' . $keyword . '%')
          ->orWhere('company_phone_my', 'LIKE', '%' . $keyword . '%');
      }
      return $query;
    })
      ->orderBy('created_at', 'DESC')
      ->paginate(100);
    return view('applications.index', compact('applications'));
  }
  public function byUserId(int $userId, Request $request)
  {
    $applications = Application::with(['user'])->whereUserId($userId)->orderBy('created_at', 'DESC')->get();
    return view('applications.by_user', compact('applications'));
  }

  public function edit(Application $application)
  {
    $application->load('customer');
    return view('applications.edit', compact('application'));
  }
  public function update(Request $request, Application $application)
  {
    $data = $request->only([
      'status',
      'contract_date',
      'contract_ad_code',
      'contract_purchased_product',
      'contract_product_qty',
      'contract_purchased_amount',
      'contract_product_price_total',
      'contract_penalty',
      'contract_purchase_method',
      'contract_payment_shipping_day',
      'contract_deferred_payment_shipping_day',
    ]);
    $photo_fields = [
      'photo_wish_item',
      'photo_selfie',
      'photo_1',
      'photo_2',
      'photo_3',
      'photo_insurance_card',
      'photo_other',
      'photo_other_1',
      'photo_other_2',
      'photo_other_3',
    ];
    foreach ($photo_fields as $photo_file) :
      if ($request->hasFile($photo_file)) :
        $photo_file_name = $application->user_id . '_' . $application->id . "_" . date('Ymd_Hi') . '_' . $photo_file . '.' . $request->file($photo_file)->extension();
        $request->file($photo_file)->storeAs('public/profile', $photo_file_name);
        $data[$photo_file] = $photo_file_name;
      endif;
    endforeach;
    $application->update($data);
    if ($request->referer)
      return redirect($request->referer)->with('success', __("application has been updated"));
    return redirect()->route('admin.applications.index')->with('success', __("application has been updated"));
  }
  public function update_status(Request $request)
  {
    $application = Application::find($request->id);
    if (!$application)
      return response()->json(['status' => false, 'msg' => 'Not found!']);
    Application::find($request->id)->update(['status' =>  $request->status]);
    return response()->json(['status' => true]);
  }
  public function pdf(Application $application)
  {
    $application->load('user');
    return view('applications.pdf', compact('application'));
  }
  public function pdfPrint(Application $application)
  {
    $application->load('user');
    return view('applications.pdf_print', compact('application'));
  }
  public function updateContract(Application $application, Request $request)
  {
    $data = $request->only([
      "contract_person"
    ]);
    $register_date = date('Ymd');
    $auto_id =  str_pad($application->id, 5, '0', STR_PAD_LEFT);

    $data['status'] = "contract";
    $data['contract_id'] = "{$register_date}-{$auto_id}";
    $data['contract_created_at'] = Carbon::now();
    $application->update($data);
    $application->load('user');
    return redirect()->route('admin.applications.index')->with('success', __("contract has been created"));
  }
  public function destroy(Application $application)
  {
    $application->delete();
    return redirect()->route('admin.applications.index')->with('success', __("application has been delete"));
  }

  public function export(Request $request)
  {
    $userId = $request->customer;
    $applications = Application::with(['customer'])->whereHas('customer', function ($query) use ($userId) {
      if ($userId) {
        return $query->where('id', $userId);
      }
      return $query;
    })->orderBy('created_at', 'DESC')->get();

    $filename = date('Y-m-d') . '__お申込み内容一覧.xlsx';
    if ($userId) {
      $user = customer::find($userId);
      $filename = date('Y-m-d') . "__{$user->id}__{$user->name}__お申込み内容一覧.xlsx";
    }
    $file_path = storage_path('app/exports/' . $filename);

    $writer = new XLSXWriterHelper();
    $header = [
      "登録元サイト"  =>  "string",
      "お申込み日"  =>  "string",
      "御社名"  =>  "string",
      "ご担当者名"  =>  "string",
      "ご連絡先電話番号"  =>  "string",
      "メールアドレス"  =>  "string",
      "ご住所"  =>  "string",
      "買取希望の金額"  =>  "string",
      "ご希望のファクタリング形式"  =>  "string",
      "売掛先の企業名"  =>  "string",
      "ご住所"  =>  "string",
      "その他情報"  =>  "string",
      "電話番号"  =>  "string",
      "売掛先企業名"  =>  "string",
      "売掛先企業の本社所在地"  =>  "string",
      "売掛先の企業規模"  =>  "string",
      "売掛先の資本金"  =>  "string",
      "売掛先の業歴"  =>  "string",
      "売掛先とのお取引回数"  =>  "string",
      "売掛先との契約書の有無"  =>  "string",
      "資金調達QUICKの利用回数"  =>  "string",
      "売掛先へのご請求金額"  =>  "string",
      "概算の手数料"  =>  "string",
      "資金調達成功率"  =>  "string",
    ];
    
    $writer->writeSheetHeader('お申込み内容一覧', $header, ['fill' => "#375623", 'color' => '#fff', 'freeze_rows' => 1, 'font-style' => 'bold',  'widths' => [20, 25, 25, 20, 30, 30, 20, 25, 20, 20, 20, 30, 20, 30, 40]]);

    foreach ($applications as $application) :
      $row = [];
      $row[] = $application->prefix;
      $row[] = $application->created_at->format('Y年m月d日');
      $row[] = $application->company;
      $row[] = $application->fullname;
      $row[] = $application->phonenumber;
      $row[] = $application->email;
      $row[] = $application->address;
      $row[] = "{$application->amount}万円";
      $row[] = $application->format;

      $row[] = $application->company_office;
      $row[] = $application->company_address;
      $row[] = "$application->company_other";
      $row[] = $application->company_name;
      $row[] = "{$application->prefect}{$application->city}";
      $row[] = $application->company_size;
      $row[] = $application->receivable_capital;
      $row[] = "〒{$application->business_history}-{$application->company_zipcode2}";
      $row[] = $application->number_of_transactions;
      $row[] = $application->has_contract;
      $row[] = $application->quick_was_used;
      $row[] = "{$application->billing}%〜";
      $row[] = "{$application->percent}%〜";
      $row[] = "{$application->fundraising_price}万円～";
      
      $row[] = asset('public/files/contact/' . $application->photo_id_1);
      $row[] = asset('public/files/contact/' . $application->photo_id_2);
      $row[] = asset('public/files/contact/' . $application->photo_bill);
      $row[] = asset('public/files/contact/' . $application->photo_item);
      $writer->writeSheetRow('お申込み内容一覧', $row,  array('valign' => 'top', 'wrap_text' => true));
    endforeach;

    $writer->writeToFile($file_path);

    if (file_exists($file_path)) {
      ob_end_clean(); // this is solution
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . XLSXWriterHelper::sanitize_filename($filename) . '"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file_path));
      readfile($file_path);
      unlink($file_path);
    }
    die;
  }
}
