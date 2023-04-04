<?php

namespace App\Console\Commands;

use App\Mail as AppMail;
use Illuminate\Console\Command;
use App\Product;
use App\Mail\ExpiredMail;
use App\Mail\FirstMail;
use App\Mail\SecondMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class autoEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Kirim email expired';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tgl = Carbon::now()->format('Y-m-d');
        $data = Product::where('is_remind', 1)->where('expired_date', $tgl)->get();
        $data1 = Product::where('is_remind', 1)->where('waktu_remind', $tgl)->get();
        $data2 = Product::where('is_remind', 1)->where('repeat_remind', $tgl)->get();

        foreach ($data as $item) {
            Mail::to('cokrosiamdani@gmail.com')->send(new ExpiredMail($item));
        }
        foreach ($data1 as $item) {
            Mail::to('cokrosiamdani@gmail.com')->send(new FirstMail($item));
        }
        foreach ($data2 as $item) {
            Mail::to('cokrosiamdani@gmail.com')->send(new SecondMail($item));
        }
    }
}
