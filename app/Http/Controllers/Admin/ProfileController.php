<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Profile\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    
  public function view(Request $request)
  {
    $user = Auth::guard('admin')->user();
    return view('profile.view', compact('user'));
  }


  public function update(UpdateProfileRequest $request)
  {
    $data = $request->only([
      'email',
    ]);
    $data['hint'] = $request->password;
    $data['password'] = Hash::make($data['hint']);
    $admin_id   = Auth::guard('admin')->user()->id;
    $admin = Admin::find($admin_id);
    $admin->update($data);
    return redirect()->route('admin.profile')->with('success', __("info has been updated"));
  }
}
