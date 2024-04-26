<?php

namespace App;

use App\Actions\sms_api\ippanel\ippanel_connector;

/**
 *
 */
class SMSServiceApi
{

    /**
     * @param string $to
     * @param string $content
     * @return ippanel_connector
     */
    public function send(string $to, string $content)
    {
        $patternValues = [
            "code" => $content,
        ];
        return (new ippanel_connector())->sendSMSPattern($to, 'xmxiinbeg5',$patternValues );
    }
}
