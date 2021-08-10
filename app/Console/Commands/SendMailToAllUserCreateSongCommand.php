<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendMailToAllUserCreateSongJob;
use App\Models\Song;
use App\Models\User;
use Carbon\Carbon;

class SendMailToAllUserCreateSongCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-alluser';

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
        $songs = Song::whereDate('created_at', Carbon::today())->get();
        $users = User::isNotAdmin()->get();
        foreach ($users as $user) {
            dispatch(new SendMailToAllUserCreateSongJob($user, $songs));
        }
    }
}
