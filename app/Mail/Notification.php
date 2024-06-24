<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Notification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $title;
     public $subject;
     public $area;
     public $date;
     public $ticketNumber;
     public $entity;
     public $employee;
     public $link;
     public $problem;

    public function __construct($title,$subject,$area,$date,$ticketNumber,$entity,$employee,$link,$problem)
    {
        $this->title = $title;
        $this->subject = $subject;
        $this->area = $area;
        $this->date = $date;
        $this->ticketNumber = $ticketNumber;
        $this->entity = $entity;
        $this->employee = $employee;
        $this->link = $link;
        $this->problem = $problem;
        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.areaMail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
