<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAlbumsMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $albums;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($albums)
    {
        $this->albums = $albums;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('home.newAlbumsMail'))
            ->view('email.allNewAlbums', ['albums' => $this->albums]);
    }
}
