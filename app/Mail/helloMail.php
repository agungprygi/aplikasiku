<?php

namespace App\Mail;

use App\Models\Surat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class helloMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $surat;
    /**
     * Create a new message instance.
     */
    public function __construct(Surat $surat)
    {
        $this->surat = $surat;
    }

    public function build()
    {
        $filePath = public_path($this->surat->dokumen);

        return $this->markdown('mail.hello')
                    ->subject('Surat Lembar Disposisi Pejabat')
                    ->attach($filePath, [
                        'as' => 'LDP.pdf',
                        'mime' => 'application/pdf',
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Surat Lembar Disposisi Pejabat',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.hello',
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
