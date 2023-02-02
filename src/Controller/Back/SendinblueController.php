<?php

namespace App\Controller\Back; ;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\EmailTemplate;

class SendinblueController extends AbstractController
{
    public function sendMail(EmailTemplate $email)
    {
        $client = new Client();

        $response = $client->post(
            'https://api.sendinblue.com/v3/smtp/email',
            [
                'headers' => [
                    'accept' => 'application/json',
                    'api-key' => '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', // MODIFY THIS (PUBLICLY EXPOSED KEY) 
                    'content-type' => 'application/json',
                ],
                'json' => [
                    'sender' => [
                        'email' => $email->getFrom(),
                    ],
                    'to' => [
                        [
                            'email' => $email->getTo(),
                        ],
                    ],
                    'subject' => $email->getSubject(),
                    'htmlContent' => $email->getHtmlTemplate()
                ],
            ]
        );
        return new Response();
    }
}
?> 