<?php 

namespace App\Controller\Back; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use GuzzleHttp\Client;

// ...
#[Route('/mail', name: 'mail')]
class SendinblueController extends AbstractController
{
    public function sendMail()
    {
        $client = new Client();

        $response = $client->post(
            'https://api.sendinblue.com/v3/smtp/email',
            [
                'headers' => [
                    'accept' => 'application/json',
                    'api-key' => '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',
                    'content-type' => 'application/json',
                ],
                'json' => [
                    'sender' => [
                        'name' => 'Herve Herve',
                        'email' => 'rv.cousin@test.com',
                    ],
                    'to' => [
                        [
                            'email' => 'rv.cousin@yahoo.fr',
                            'name' => 'Herve Hervebis',
                        ],
                    ],
                    'subject' => 'Ca marche !',
                    'htmlContent' => '<html><head></head><body><p>Hello,</p>This is my first transactional email sent from Sendinblue.</p></body></html>',
                ],
            ]
        );
    }

    // TODO
}


?> 