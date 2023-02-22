<?php

namespace App\Controller\User;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use App\Form\UserPaymentType;
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
        
        $formWithdrawal = $this->createForm(UserPaymentType::class, $user);
        $formWithdrawal->handleRequest($request);
        
        $formDeposit = $this->createForm(UserPaymentType::class, $user);
        $formDeposit->handleRequest($request);
        
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

        return $this->render('user/profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'formDeposit' => $formDeposit,
            'formWithdrawal' => $formWithdrawal,
            'user' => $this->getUser()
        ]);
    }
}
