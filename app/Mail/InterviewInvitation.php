<?php

namespace App\Mail;

use App\Models\Applier;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterviewInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $applier;
    public $vconLink;

    /**
     * Create a new message instance.
     */
    public function __construct(Applier $applier, $vconLink = null)
    {
        $this->applier = $applier;
        $this->vconLink = $vconLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $name = $this->applier->first_name . ' ' . ($this->applier->last_name ?? '');
        return new Envelope(
            from: new Address(
                config('mail.interview_from.address', 'rekrutmen@livasya.com'),
                config('mail.interview_from.name', 'HRD RS Livasya')
            ),
            subject: 'Undangan Wawancara Kerja - ' . trim($name) . ' - RS Livasya',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.interview_invitation',
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
