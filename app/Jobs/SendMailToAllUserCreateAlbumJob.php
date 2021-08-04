<?php

namespace App\Jobs;

use App\Mail\NewAlbumsMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMailToAllUserCreateAlbumJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $albums;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $albums)
    {
        $this->user = $user;
        $this->albums = $albums;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new NewAlbumsMail($this->albums);
        Mail::to($this->user->email)->send($email);
    }
}
