<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Entity\EmailTemplate;
use App\Entity\User;
use App\Security\EmailVerifier;

class ResetPwdController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/reset_pwd', name: 'app_reset_pwd')]
    public function index(): Response
    {
        $user = new User();
        dump($user->getId());

        $email = new EmailTemplate();

            $email->addressFrom = 'betsoflegends@test.com';
            $email->addressTo = $user->getEmail();
            $email->subject = 'Reseting your password';
            $email->htmlTemplatePath = 'registration/resetPwd.html.twig';
        $this->emailVerifier->sendResetPwdEmail($email);

        return $this->render('reset_pwd/resetPwd_info.html.twig');
    }
}