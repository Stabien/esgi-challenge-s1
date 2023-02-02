<?php

namespace App\Controller\Back; ;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SendinblueController extends AbstractController
{
    #[Route('/sendinblue', name: 'app_sendinblue')]
    public function index(): Response
    {
        return $this->render('sendinblue/index.html.twig', [
            'controller_name' => 'SendinblueController',
        ]);
    }
    #[Route('/mail', name: 'mail')]
    public function sendMail()
    {
        $client = new Client();

        $response = $client->post(
            'https://api.sendinblue.com/v3/smtp/email',
            [
                'headers' => [
                    'accept' => 'application/json',
                    'api-key' => $apiKey = getenv('SENDINBLUE_API_KEY'), // MODIFY THIS (PUBLICLY EXPOSED KEY) 
                    'content-type' => 'application/json',
                ],
                'json' => [
                    'sender' => [
                        'name' => 'Herve Herve',
                        'email' => 'rv.cousin@amazon.com',
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

        return new Response();
    }


}


?> 