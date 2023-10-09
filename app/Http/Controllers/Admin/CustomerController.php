<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Helper\XLSXWriterHelper;
use App\Http\Requests\Admin\Customer\CreateCustomerRequest;
use App\Http\Requests\Admin\Customer\UpdateCustomerRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $keyword = $request->input('keyword');
    $customers = Customer::with('lastApplication')->orderBy('register_date', 'DESC')
      ->where(function ($query) use ($keyword) {
        if ($keyword) {
          return $query->where('email', 'LIKE', '%' . $keyword . '%')
            ->orWhere('fullname', 'LIKE', '%' . $keyword . '%')
            ->orWhere('phonenumber', 'LIKE', '%' . $keyword . '%');
        }
        return $query;
      })
      ->paginate(100);
    return view('customers.index', compact('customers'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function export()
  {

    $customers = Customer::orderBy('register_date', 'DESC')->get();

    $filename = date('Y-m-d') . '__顧客管理一覧.xlsx';
    $file_path = storage_path('app/exports/' . $filename);

    $writer = new XLSXWriterHelper();
    $header = [
      '登録日' => 'string',
      '名前' => 'string',
      'メールアドレス' => 'string',
      '携帯番号'  =>  'string'
    ];


    $writer->writeSheetHeader('顧客管理一覧', $header, ['fill' => "#375623", 'color' => '#fff', 'freeze_rows' => 1, 'font-style' => 'bold',  'widths' => [18, 25, 25, 18, 10, 40, 25]]);

    foreach ($customers as $customer) :
      $row = [];
      $row[] = $customer->register_date->format('Y年m月d日');
      $row[] = $customer->fullname;
      $row[] = $customer->email;
      $row[] = $customer->phonenumber;
      $writer->writeSheetRow('顧客管理一覧', $row,  array('valign' => 'top', 'wrap_text' => true));
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

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('customers.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateCustomerRequest $request)
  {
    $data = $request->only([
      'email',
      'fullname',
      'email',
      'phonenumber',
      'register_date',
      'note'
    ]);
    $data['prefix'] = "ADMIN";
    $customer = Customer::create($data);
    return redirect()->route('admin.customers.edit', ['customer' => $customer])->with('success', __(":email has been created", ["email" =>  $customer->email]));
  }
  public function edit(Customer $customer)
  {
    return view('customers.edit', compact('customer'));
  }


  public function update(Customer $customer, UpdateCustomerRequest $request)
  {
    $data = $request->only([
      'email',
      'fullname',
      'email',
      'phonenumber',
      'register_date',
      'note'
    ]);
    $customer->update($data);
    return redirect()->route('admin.customers.edit', ['customer' => $customer])->with('success', __(":email has been updated", ["email" =>  $customer->email]));
  }


  public function detail(Customer $customer)
  {
    $customer->load('applications');
    return view('customers.detail', compact('customer'));
  }
  public function note(Customer $customer, Request $request)
  {
    $customer->update($request->only(['note']));
    return redirect()->back()->with('success', __("Note has been updated"));
  }
  public function destroy(Customer $customer)
  {
    try {
      $name = $customer->name;
      $customer->delete();
      return redirect()->route('admin.customers.index')->with('success', __("この顧客を削除しました。"));
    } catch (\Exception $e) {

      return redirect()->route('admin.customers.index')->with('error', __("Can not delete customer"));
    }
  }
}
