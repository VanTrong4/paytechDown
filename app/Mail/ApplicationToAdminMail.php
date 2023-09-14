<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Application;

class ApplicationToAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $application;

    /**
     * Create a new message instance.
     */
    public function __construct(Application $application)
    {
        $this->application  = $application;
        $this->subject = getAdminSubject();
        $this->markdown =  "emails." . ($application->company_name ? 'message_admin' : "contact_message_admin");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $builder =   $this->with('application', $this->application);
        if ($this->application->photo_id_1)
        $builder->attach(public_path('files/contact/' . $this->application->photo_id_1));
        if ($this->application->photo_id_2)
        $builder->attach(public_path('files/contact/' . $this->application->photo_id_2));
        if ($this->application->photo_bill)
        $builder->attach(public_path('files/contact/' . $this->application->photo_bill));
        if ($this->application->photo_item)
        $builder->attach(public_path('files/contact/' . $this->application->photo_item));
        return $builder;
    }
}
