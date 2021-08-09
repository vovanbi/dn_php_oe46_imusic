<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\NotificationNewAlbum;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmailAlbum implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $album;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $album)
    {
        $this->user = $user;
        $this->album = $album;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new NotificationNewAlbum($this->album);
        Mail::to($this->user->email)->send($email);
    }
}
