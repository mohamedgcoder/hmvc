<?php

namespace Admins\Http\Mail;


use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminLoginNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        protected $data = [],
        protected $namespace = null,
    ) {
        $this->data = $data;
        $this->namespace = $namespace;
        // $this->afterCommit();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(_settings('mail', 'no-reply_email'), _settings('mail', 'from_name')),
            subject: 'Security alert',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = Str::ucfirst(_moduleSingular($this->namespace)).'::emails.admin_login_notification';
        return new Content(
            view: $view,
            with: [
                'data' => $this->data,
                'namespace' => $this->namespace,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            // Attachment::fromPath('/path/to/file')
            //             ->as('name.pdf')
            //             ->withMime('application/pdf'),
        ];
    }
}
