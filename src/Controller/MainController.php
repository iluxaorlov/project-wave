<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     * @IsGranted("ROLE_USER")
     *
     * @param UserRepository $userRepository
     *
     * @return Response
     */
    public function main(UserRepository $userRepository)
    {
        $users = $userRepository->findAllWithMessages($this->getUser()->getId());

        return $this->render('main/main.html.twig', [
            'users' => $users,
        ]);
    }
}
