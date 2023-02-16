<?php

namespace App\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\EmailTemplate;

class SendinblueController extends AbstractController
{
    public function sendMail(EmailTemplate $email): Response
    {
        $client = new Client();

        $response = $client->post(
            'https://api.sendinblue.com/v3/smtp/email',
            [
                'headers' => [
                    'accept' => 'application/json',
                    'api-key' => $_ENV['APP_SENDINBLUE_API_KEY'], 
                    'content-type' => 'application/json',
                ],
                'json' => [
                    'sender' => [
                        'email' => $email->addressFrom,
                    ],
                    'to' => [
                        [
                            'email' => $email->addressTo
                        ],
                    ],
                    'subject' => $email->subject,
                    'htmlContent' => $email->htmlTemplate
                ],
            ]
        );
        return new Response();
    }
}