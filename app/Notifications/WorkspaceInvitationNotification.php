<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Workspace;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WorkspaceInvitationNotification extends Notification
{
    use Queueable;

    public Workspace $workspace;

    public function __construct(
        Workspace $workspace
    )
    {
        $this->workspace = $workspace;
    }

    public function via(
        object $notifiable
    ): array
    {
        return ['database'];
    }

    public function toArray(
        object $notifiable
    ): array
    {
        return [
            'workspace_id' =>
                $this->workspace->id,

            'workspace_name' =>
                $this->workspace->name,

            'message' =>
                'You have been invited to workspace: '
                . $this->workspace->name,
        ];
    }
}