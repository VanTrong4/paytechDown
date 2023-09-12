<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
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
          ->orWhere('company_other', 'LIKE', '%' . $keyword . '%');
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
    $application->load('user');
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
    if (
      $request->status == 'complete'
      && (!$application->contract_date
        || !$application->contract_purchase_method
        || !$application->contract_purchased_product
        || !$application->contract_product_qty
        || !$application->contract_purchased_amount
      )
    )
      return response()->json(['status' => false, 'msg' => '契約日を入力してください']);
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
    $userId = $request->user;
    $applications = Application::with(['user'])->whereHas('user', function ($query) use ($userId) {
      if ($userId) {
        return $query->where('id', $userId);
      }
      return $query;
    })->orderBy('created_at', 'DESC')->get();

    $filename = date('Y-m-d') . '__お申込み内容一覧.xlsx';
    if ($userId) {
      $user = User::find($userId);
      $filename = date('Y-m-d') . "__{$user->id}__{$user->name}__お申込み内容一覧.xlsx";
    }
    $file_path = storage_path('app/exports/' . $filename);

    $writer = new XLSXWriterHelper();
    $header = [
      "お申込み日"  =>  "string",
      "名前"  =>  "string",
      "フリガナ"  =>  "string",
      "生年月日"  =>  "string",
      "性別"  =>  "string",
      "メールアドレス"  =>  "string",
      "パスワード"  =>  "string",
      "ご希望の連絡方法"  =>  "string",
      "LINE ID"  =>  "string",
      "郵便番号"  =>  "string",
      "都道府県"  =>  "string",
      "市区町村"  =>  "string",
      "番地"  =>  "string",
      "マンション名・部屋番号"  =>  "string",
      "勤務先の情報 郵便番号"  =>  "string",
      "勤務先の情報 都道府県"  =>  "string",
      "勤務先の情報 市区町村"  =>  "string",
      "勤務先の情報 番地"  =>  "string",
      "勤務先の情報 マンション名・部屋番号"  =>  "string",
      "勤務先の情報 電話番号"  =>  "string",
      "銀行名"  =>  "string",
      "支店名"  =>  "string",
      "支店番号"  =>  "string",
      "口座の種類"  =>  "string",
      "口座番号"  =>  "string",
      "口座名義(カナ)" =>  "string",
      "セルフィー（自画撮り）" => "string",
      "運転免許証、または顔写真付きの身分証明書-表面" => "string",
      "運転免許証、または顔写真付きの身分証明書-裏面" => "string",
    ];


    $writer->writeSheetHeader('お申込み内容一覧', $header, ['fill' => "#375623", 'color' => '#fff', 'freeze_rows' => 1, 'font-style' => 'bold',  'widths' => [20, 25, 25, 20, 30, 30, 20, 25, 20, 20, 20, 30, 20, 30, 40]]);

    foreach ($applications as $application) :
      $row = [];
      $row[] = $application->created_at->format('Y年m月d日');
      $row[] = $application->user->name;
      $row[] = $application->user->furigana;
      $row[] = $application->user->birthday->format('Y年m月d日');
      $row[] = $application->user->gender;
      $row[] = $application->user->email;
      $row[] = $application->user->hint;
      $row[] = $application->preferred_contact;
      $row[] = $application->line_id;
      $row[] = "〒{$application->zipcode1}-{$application->zipcode2}";
      $row[] = $application->prefect;
      $row[] = $application->district;
      $row[] = $application->address;
      $row[] = $application->apartment_room;
      $row[] = "〒{$application->company_zipcode1}-{$application->company_zipcode2}";
      $row[] = $application->company_prefect;
      $row[] = $application->company_district;
      $row[] = $application->company_address;
      $row[] = $application->company_apartment_room;
      $row[] = $application->company_phonenumber;
      $row[] = $application->bank_name;
      $row[] = $application->branch_name;
      $row[] = $application->branch_number;
      $row[] = $application->account_type;
      $row[] = $application->account_number;
      $row[] = $application->account_name_kana;
      $row[] = asset('storage/profile/' . $application->photo_selfie);
      $row[] = asset('storage/profile/' . $application->photo_1);
      $row[] = asset('storage/profile/' . $application->photo_2);
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
