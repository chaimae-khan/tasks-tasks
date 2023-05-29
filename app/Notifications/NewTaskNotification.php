<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTaskNotification extends Notification
{
    use Queueable;
    public $todo;
    public $task_id;
    public $create_task;
    

    public function __construct($task_id,$create_task,$todo)
    {
        $this->task_id = $task_id;
        $this->create_task = $create_task;
        $this->todo=$todo;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage);
        // ->subject('New Task Created')
        // ->line('A new task has been created:')
        // ->line($this->task->name)
        // ->action('View Task', url('/admin'))
        // ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'task_id' => $this->task_id,
            'create_task'=>$this->create_task,
            'todo' =>$this->todo,
            
           /*  'link' => url('/admin'), */
        ];
    }
}
