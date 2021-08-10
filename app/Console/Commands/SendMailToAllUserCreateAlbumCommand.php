<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Album;
use Illuminate\Console\Command;
use App\Jobs\SendMailToAllUserCreateAlbumJob;

class SendMailToAllUserCreateAlbumCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'album:sendAllUsers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send New Albums Email To All Users';

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
        $albums = Album::whereDay('created_at', date('d'))->get();
        $users = User::isNotAdmin()->get();
        foreach ($users as $user) {
            dispatch(new SendMailToAllUserCreateAlbumJob($user, $albums));
        }
    }
}
