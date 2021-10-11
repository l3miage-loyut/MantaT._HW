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
            $remain = ceil($datediff / (60 * 60 * 24));
            $remain == -0 ? $remain = 0 : null;

            if (is_numeric($item->days_to_remind) & $remain == $item->days_to_remind) {
                $idUser = $item->idUser;
                $user = User::find($idUser);
                $name = $user->name;
                $to = $user->email;
                $text = $item->title . " remains " . $remain . " day(s) until its due date.";
                Mail::raw($text, function ($message) use ($to, $name){
                    $message->to($to, $name)->subject('Reminder');
                });
            }
        }
        return 0;
    }
}
