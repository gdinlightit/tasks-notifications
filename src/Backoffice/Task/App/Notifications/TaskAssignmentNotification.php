<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Lightit\Backoffice\Employee\Domain\Models\Employee;
use Lightit\Backoffice\Task\Domain\Models\Task;

class TaskAssignmentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private string $title;

    public function __construct(
        private readonly Task $task,
        private readonly bool $isReassignment = false,
        private Employee|null $previousEmployee = null,
    ) {
        $this->title = $isReassignment ? 'Task Reassignment' : 'New Task Assignment';
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(Employee $notifiable): MailMessage
    {
        /**
         * @var string
         */
        $fromMail = config('mail.from.address', 'DoNotReply@lightit.io');

        return (new MailMessage())
            ->from($fromMail)
            ->subject($this->title)
            ->view('mail.assigned-task', [
                'title' => $this->title,
                'task' => $this->task,
                'isReassignment' => $this->isReassignment,
                'previousEmployee' => $this->previousEmployee,
            ]);
    }
}
