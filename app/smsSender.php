<?php

namespace App;

use Fouladgar\OTP\Contracts\SMSClient;
use Fouladgar\OTP\Notifications\Messages\MessagePayload;

class smsSender implements SMSClient
{
    public function __construct(protected SMSServiceApi $SMSService)
    {
    }

    /**
     * @param MessagePayload $payload
     * @return mixed
     */
    public function sendMessage(MessagePayload $payload): mixed
    {
        return $this->SMSService->send($payload->to(), $payload->content());
    }

    // ...
}
