<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use App\Form\UserPaymentType;
use App\Form\UserIbanType;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    public function __construct(ManagerRegistry $doctrine) 
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/profile', name: 'app_user_profile')]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $currentUser = $this->getUser();

        $entityManager = $this->doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($currentUser->getId());

        $currentCreditCardNumber = $currentUser->getCreditCardNumber();
        $currentCreditCardExpiration = $currentUser->getCreditCardExpiration();
        $currentCreditCardSecret = $currentUser->getCreditCardSecret();
        $currentIban = $currentUser->getIban();

        $formDeposit = $this->createForm(UserPaymentType::class, $user);
        $formDeposit->handleRequest($request);
        
        $formWithdrawal = $this->createForm(UserIbanType::class, $user);
        $formWithdrawal->handleRequest($request);

        if ($formDeposit->isSubmitted() && $formDeposit->isValid()) {
            $user->setBalance($user->getBalance() + $formDeposit['amount']->getData());

            if ($formDeposit['saveCreditCard']->getData() == false) {
                $user->setCreditCardNumber($currentCreditCardNumber);
                $user->setCreditCardExpiration($currentCreditCardExpiration);
                $user->setCreditCardSecret($currentCreditCardSecret);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_user_profile');
        }

        if ($formWithdrawal->isSubmitted() && $formWithdrawal->isValid()) {
            $balance = $user->getBalance() - $formWithdrawal['amount']->getData();

            if ($balance >= 0) {
                $user->setBalance($user->getBalance() - $formWithdrawal['amount']->getData());

                if ($formWithdrawal['saveIban']->getData() == false) {
                    $user->setIban($currentIban);
                }
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_user_profile');
        }

        return $this->render('user/profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'formDeposit' => $formDeposit,
            'formWithdrawal' => $formWithdrawal,
            'user' => $this->getUser()
        ]);
    }
}
