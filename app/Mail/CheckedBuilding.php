<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CheckedBuilding extends Mailable
{
    use Queueable, SerializesModels;

    public $buildings;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($buildings)
    {
        $this->buildings = $buildings;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.buildings')->with([
            'buildings' => $this->buildings
        ]);
    }
}
