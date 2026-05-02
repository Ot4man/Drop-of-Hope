<?php

namespace App\Notifications;

use App\Models\BloodRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UrgentBloodRequestNotification extends Notification
{
    use Queueable;

    protected $bloodRequest;

    public function __construct(BloodRequest $bloodRequest)
    {
        $this->bloodRequest = $bloodRequest;
    }

    
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'blood_request_id' => $this->bloodRequest->id,
            'blood_type'       => $this->bloodRequest->blood_type,
            'urgency'          => $this->bloodRequest->urgency,
            'location'         => $this->bloodRequest->location,
            'hospital_name'    => $this->bloodRequest->hospital->hospitalProfile->hospital_name ?? 'A Hospital',
            'message'          => "Urgent need for {$this->bloodRequest->blood_type} blood units!",
        ];
    }
}
