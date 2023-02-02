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
                    'htmlContent' => '<html>
                    <head></head>
                    <body>
                        <div class="title">
                            <p>Bets of Legends</p>
                        </div>
                        <div class="text">
                            <p>Bonjour champion
                                Nous sommes ravis de vous accueillir parmi nous ! <br> Afin de finaliser votre inscription, 
                                veuillez cliquer sur le lien ci-dessous :</p>
                            <p>{{ insert_link }}</p>
                            <p>Cette étape vous permettra d\'activer votre compte et d\'accéder à toutes les 
                                fonctionnalités de notre site. <br> Nous vous remercions pour votre confiance et nous 
                                tenons à votre disposition pour toute question.</p>
                        </div>
                        
                        <div class="image">
                             <img src="https://static.wikia.nocookie.net/villains-fr/images/9/90/Jinx_LOL_Render_2.png/revision/latest?cb=20201001194043&path-prefix=fr" alt="">
                        </div>
                        
                    </body>
                
                    <style>
                        body {
                            max-width: 95%;
                            margin: auto;
                        }
                        .title {
                            color: #D0A85C;
                            font: italic bold 40px Beaufort for LOL, Spiegel;
                            display: flex;
                            justify-content: center;
                        }
                
                        .title p {
                            text-align: center;
                        }
                
                        .text {
                            margin-bottom: 60px;
                            font: 20px Spiegel;
                        }
                
                        .image {
                            display: flex;
                            justify-content: center;
                        }
                
                        .image::before {
                            content: "";
                            width: 200px;
                            height: 200px;
                            border-color: #D0A85C;
                            position: absolute;
                            border-style: solid;
                            align-self: center;
                            transform: rotate(45deg);
                        }
                
                        .image img {
                            z-index: 1;
                            max-width: 200px;
                        }
                
                        @media screen and (max-width:1080px) {
                            body {
                            max-width: 80%;
                            margin: auto;
                            }
                        }
                    </style>
                    </html>',
                ],
            ]
        );

        return new Response();
    }


}


?> 