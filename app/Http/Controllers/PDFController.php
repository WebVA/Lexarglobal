<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Mail;

class PDFController extends Controller
{
    public function index()
    {
        $data["email"] = "csh10088@gmail.com";
        $data["title"] = "From ItSolutionStuff.com";
        $data["body"] = "This is Demo";

        $pdf = PDF::loadView('emails.testemail', $data);

        Mail::send('emails.testemail', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])->subject($data["title"])->attachData($pdf->output(), "text.pdf");
        });

        dd('Mail sent successfully');
    }

    public function email_moreinfo()
    {
        $data["email"] = request()->moreinfo_email;
        $data["title"] = "From " . request()->moreinfo_name;
        $data["body"] = "This is Demo";

        //$pdf = PDF::loadView('emails.moreinfo', $data);

        Mail::send('emails.moreinfo', $data, function ($message) use ($data) {
            $message->to($data["email"], $data["email"])->subject($data["title"]);
        });

        dd('Mail sent successfully');
    }
}
