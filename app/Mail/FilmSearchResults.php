<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FilmSearchResults extends Mailable
{
    use Queueable, SerializesModels;

    public $film;
    public $subject;
    public $message;

    /**
     * Create a new message instance.
     *
     * @param $film
     * @param $subject
     * @param $message
     */
    public function __construct($film, $subject, $message)
    {
        $this->film = $film;
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Формуємо HTML для тіла листа
        $htmlContent = "<h1>{$this->film['Title']}</h1>";
        $htmlContent .= "<p><strong>Year:</strong> {$this->film['Year']}</p>";
        $htmlContent .= "<p><strong>Genre:</strong> {$this->film['Genre']}</p>";
        $htmlContent .= "<p><strong>Director:</strong> {$this->film['Director']}</p>";
        $htmlContent .= "<p><strong>Plot:</strong> {$this->film['Plot']}</p>";
        $htmlContent .= "<p><strong>Actors:</strong> {$this->film['Actors']}</p>";
        $htmlContent .= "<p><strong>IMDB Rating:</strong> {$this->film['imdbRating']}</p>";
        $htmlContent .= "<p><strong>Message:</strong> {$this->message}</p>";

        return $this->subject($this->subject)
            ->html($htmlContent); // Встановлюємо HTML як вміст листа
    }
}
