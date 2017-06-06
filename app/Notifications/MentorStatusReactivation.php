<?php

namespace App\Notifications;

use App\Models\eloquent\MentorshipSession;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MentorStatusReactivation extends Notification
{
    use Queueable;

    private $mentor;

    /**
     * Create a new notification instance.
     */
    public function __construct($mentor)
    {
        $this->mentor = $mentor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Job-Pairs | Η συνεδρία σας ολοκληρώθηκε!")
            ->greeting('Αγαπητέ mentor,')
            ->line('Συγχαρητήρια!')
            ->line('<div style="margin-top: 1em; color: #74787E; font-size: 16px; line-height: 1.5em;">Θα θέλαμε να σας ενημερώσουμε πως μόλις ολοκληρώθηκε μια συνεδρία στην οποία συμμετείχατε.</span>')
            ->line('<div style="margin-top: 1em; color: #74787E; font-size: 16px; line-height: 1.5em;">Μπορείτε εάν το επιθυμείτε να θέσετε το προφίλ σας διαθέσιμο για νέα συνεδρία κάνοντας κλικ στο παρακάτω σύνδεσμο.</span>')
            ->action('Επιθυμώ νέα συνεδρία', route('setMentorStatusAvailable', ['id' => $this->mentor->id, 'email' => $this->mentor->email]))
            ->line('<div style="margin-top: 1em; color: #74787E; font-size: 16px; line-height: 1.5em;">Με εξαιρετική εκτίμηση,</div>')
            ->line('Η ομάδα του Job-Pairs')->to($notifiable->routeNotificationFor('mail'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
