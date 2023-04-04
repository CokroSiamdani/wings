<?php
//file ini belum terpakai
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyTestMail;
use App\Product;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {

        // $details = [
        //     'title' => 'Mail from websitepercobaan.com',
        //     'body' => 'This is for testing email using smtp cokro'
        // ];

        // Mail::to('cokrosiamdani@gmail.com')->send(new MyTestMail($details));

        Mail::send('emails.myTestMail', [], function ($m) {
            $m->from('cokro.siamdani@saranalegalitas.id', 'Cokro Siamdani');
            $m->to('cokrosiamdani@gmail.com')->subject("Mail from websitepercobaan.com");
        });

        dd("Email sudah terkirim.");
    }
}
