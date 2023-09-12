<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Mail\ApplicationToCustomerMail;
use App\Mail\ApplicationToAdminMail;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function gotoContact ( Request $request)
    {
        $data = $request;
        // dd($data);
        return view('top.contact', compact('data'));
    }

    public function submit ( Request $request)
    {
        checkValidations();
        
        $data = $request->only([
            'company_name',
            'prefect',
            'city',
            'company_size',
            'receivable_capital',
            'business_history',
            'number_of_transactions',
            'has_contract',
            'quick_was_used',
            'billing',
            'percent',
            'fundraising_percent',
            'fundraising_price',

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
        ]);
        $photo_fields = [
            'photo_id_1',
            'photo_id_2',
            'photo_bill',
            'photo_item',
        ];
        $data['prefix'] = prefix() ?: 'top';
        $application = Application::create($data);

        $attachments = [];

        $upload_dir = public_path('files/contact');

        foreach ($photo_fields as $photo_file){
            if($request->hasFile($photo_file)){
                $photo_file_name = $application->id . '_' . date('Ymd_Hi') . '_' . $photo_file . '.' . $request->file($photo_file)->extension();
                $request->{$photo_file}->move($upload_dir, $photo_file_name);
                $attachments[$photo_file] = $photo_file_name;
            }
            $application->update($attachments);
        }


        Mail::to($application->email)->send(new ApplicationToCustomerMail($application));
    
        $mailToAdmin = Mail::to(getAdminEmail());
        if ($bcc = getAdminEmailBcc()) {
          $mailToAdmin->bcc($bcc);
        }
        $mailToAdmin->send(new ApplicationToAdminMail($application));
        return redirect(route(lp() . 'thanks'));
    }
}
