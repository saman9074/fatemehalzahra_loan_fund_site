<?php

namespace App\Actions\sms_api\ippanel;

/**
 *
 */
class ippanel_connector
{
    public function __construct()
    {

    }

    /**
     * @param $phoneNumber
     * @param $message
     * @param $pattern
     * @param $patternValues
     * @return void
     */
    public function sendSMSPattern($phoneNumber, $pattern, $patternValues)
    {
        $apiKey = env('IPPANELAPI', 'Laravel');
        $client = new \IPPanel\Client($apiKey);

        try{
            $messageId = $client->sendPattern($pattern,"983000505", $phoneNumber, $patternValues);
        } catch (Error $e) { // ippanel error
            var_dump($e->unwrap()); // get real content of error
            echo $e->getCode();

            // error codes checking
            if ($e->code() == ResponseCodes::ErrUnprocessableEntity) {
                echo "Unprocessable entity";
            }
        } catch (HttpException $e) { // http error
            var_dump($e->getMessage()); // get stringified error
            echo $e->getCode();
        }
    }

    /**
     * @throws \IPPanel\Errors\HttpException
     * @throws \IPPanel\Errors\Error
     */
    public function getCredits(): float
    {
        $apiKey = env('IPPANELAPI', 'Laravel'); //'V7Dm05qvwSTrj9f-QxB28-5c2cYiBpGw6T7Q12DdgD8=';

        return (new \IPPanel\Client($apiKey))->getCredit();
    }
}
