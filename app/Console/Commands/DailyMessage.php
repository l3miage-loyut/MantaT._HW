<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Mail;
use App\Models\Item;
use App\Models\User;

class DailyMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan command to send daily messages';

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
     * @return int
     */
    public function handle()
    {
        foreach (Item::all() as $item) {
            $now = time();
            $due_date = strtotime($item->dueDate);
            $datediff = $due_date - $now;
            $remain = round($datediff / (60 * 60 * 24));

            //if ($remain == $item->days_to_remind) {
            if ($remain == 1) {
                $idUser = $item->idUser;
                $user = User::find($idUser);
                $name = $user->name;
                $to = $user->email;
                $text = $item->title . " remains " . $remain . " days until its due date.";
                Mail::raw($text, function ($message) use ($to, $name){
                    $message->to($to, $name)->subject('Reminder');
                });
            }
        }
        return 0;
    }
}
