<?php

namespace App\Security;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use App\Controller\Back\SendinblueController;
use App\Entity\EmailTemplate;
use Twig\Environment;

class EmailVerifier
{
    private $twig;

    public function __construct(
        private VerifyEmailHelperInterface $verifyEmailHelper,
        private SendinblueController $mailer,
        private EntityManagerInterface $entityManager,
        Environment $twig
    ) {
        $this->twig = $twig;
    }

    public function sendEmailConfirmation(string $verifyEmailRouteName, UserInterface $user, EmailTemplate $email): void
    {
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            $verifyEmailRouteName,
            $user->getId(),
            $user->getEmail()
        );

        $email->htmlTemplate = $this->twig->render($email->htmlTemplatePath, [
            'signedUrl' => $signatureComponents->getSignedUrl(),
            'expiresAtMessageKey' => $signatureComponents->getExpirationMessageKey(),
            'expiresAtMessageData' => $signatureComponents->getExpirationMessageData()
        ]);

        $this->mailer->sendMail($email);
    }

    public function sendResetPwdEmail(EmailTemplate $email):void
    {
        $this->mailer->sendMail($email);
    }

    /**
     * @throws VerifyEmailExceptionInterface
     */
    public function handleEmailConfirmation(Request $request, UserInterface $user): void
    {
        $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());

        $user->setIsVerified(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
