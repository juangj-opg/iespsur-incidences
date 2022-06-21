<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tipo, $info)
    {
        $this->tipo = $tipo;
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Según el tipo que le llegue, tendrá una salida diferente.
        $tipo = $this->tipo;

        if ($tipo == "comment") {
            return $this
                ->subject("Incidencias IES PSur - Se ha añadido un nuevo comentario")
                ->view('emails.commentMail')
                ->with([
                    'info' => $this->info,
                ]);;
        } else if ($tipo == "new") {
            return $this
                ->subject("Incidencias IES PSur - Nueva incidencia")
                ->view('emails.newMail')
                ->with([
                    'info' => $this->info,
                ]);
        } else if ($tipo == "closed") {
            return $this
                ->subject("Incidencias IES PSur - Se ha cerrado tu incidencia")
                ->view('emails.closedMail')
                ->with([
                    'info' => $this->info,
                ]);
        }
    }
}
