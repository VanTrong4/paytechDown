<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterAd;
use Illuminate\Http\Request;
use App\Helper\XLSXWriterHelper;

class MasterAdController extends Controller
{
  private $limit  = 25;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $keyword = $request->input('keyword');
    $items = MasterAd::orderBy('created_at', 'DESC')
      ->where(function ($query) use ($keyword) {
        if ($keyword) {
          return $query->where('code', 'LIKE', '%' . $keyword . '%')
            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('remarks', 'LIKE', '%' . $keyword . '%');
        }
        return $query;
      })
      ->paginate($this->limit);
    return view('master_ads.index', compact('items'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('master_ads.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $data = $request->only([
      'code',
      'name',
      'remarks',
    ]);
    $masterAd = MasterAd::create($data);

    return redirect()->route('admin.master_ads.index')->with('success', __("この広告マスターの新規作成は完了しました。", ["name" =>  $masterAd->name]));
  }
  public function edit(MasterAd $masterAd)
  {
    return view('master_ads.edit', compact('masterAd'));
  }


  public function update(MasterAd $masterAd, Request $request)
  {
    $data = $request->only([
      'code',
      'name',
      'remarks',
    ]);
    $masterAd->update($data);

    return redirect()->route('admin.master_ads.index')->with('success', __("この広告マスターの情報更新は完了しました。"));
  }

  public function destroy(MasterAd $masterAd)
  {
    try {
      //$name = $masterAd->name;
      $masterAd->delete();
      return redirect()->route('admin.master_ads.index')->with('success', __("この広告マスターの削除は完了しました。"));
    } catch (\Exception $e) {

      return redirect()->route('admin.master_ads.index')->with('error', __("Can not delete! Try again later"));
    }
  }

  public function export(Request $request)
  {
    $items = MasterAd::orderBy('created_at', 'DESC')->get();
    $filename = date('Y-m-d') . '__広告マスター.xlsx';
    $file_path = storage_path('app/exports/' . $filename);

    $writer = new XLSXWriterHelper();
    $header = [
      "No."  =>  "string",
      "コード"  =>  "string",
      "広告名"  =>  "string",
      "備考"  =>  "string",
    ];


    $writer->writeSheetHeader('広告マスター', $header, ['fill' => "#375623", 'color' => '#fff', 'freeze_rows' => 1, 'font-style' => 'bold',  'widths' => [10, 30, 30, 50]]);

    foreach ($items as $key => $item) :
      $row = [];
      $no = $key + 1;
      $row[] = $no;
      $row[] = $item->code;
      $row[] = $item->name;
      $row[] = $item->remarks;

      $writer->writeSheetRow('広告マスター', $row,  array('valign' => 'top', 'wrap_text' => true));
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
  public function print(Request $request)
  {
    $keyword = $request->input('keyword');
    $items = MasterAd::orderBy('created_at', 'DESC')
      ->where(function ($query) use ($keyword) {
        if ($keyword) {
          return $query->where('code', 'LIKE', '%' . $keyword . '%')
            ->orWhere('name', 'LIKE', '%' . $keyword . '%')
            ->orWhere('remarks', 'LIKE', '%' . $keyword . '%');
        }
        return $query;
      })
      ->paginate($this->limit);
    return view('master_ads.print', compact('items'));
  }
}
