<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportResponseNotification extends Notification
{
    use Queueable;

    protected $report;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
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
                    ->line('لقد تم تحديث استجابتك للبلاغ.')
                    ->line('نص الاستجابة: ' . $this->report->text_2)
                    ->action('عرض البلاغ', url('/reports/' . $this->report->id))
                    ->line('شكراً لاستخدامك تطبيقنا!');
    }
}
