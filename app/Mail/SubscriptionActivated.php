<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class SubscriptionActivated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $subscription;
    public $invoice;
    public $amount_in_words;

    public function __construct($subscription, $invoice = null, $amount_in_words = null)
    {
        $this->subscription = $subscription;
        $this->invoice = $invoice;
        $this->amount_in_words = $amount_in_words;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'License Activated | PASIWARE HRM',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.subscription_activated',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        if (!$this->invoice) return [];

        // Logic to pass additional info to PDF view
        $item_name = $this->subscription->plan->plan_name;
        $item_capacity = $this->subscription->employee_capacity;

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $this->invoice,
            'item_name' => $item_name,
            'item_capacity' => $item_capacity,
            'amount_in_words' => $this->amount_in_words
        ]);

        return [
            \Illuminate\Mail\Mailables\Attachment::fromData(fn () => $pdf->output(), $this->invoice->invoice_no . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
