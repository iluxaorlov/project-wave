<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\MessageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    /**
     * @Route("/chat/{id}", name="chat")
     * @IsGranted("ROLE_USER")
     *
     * @param User $user
     * @param MessageRepository $repository
     *
     * @return Response
     */
    public function chat(User $user, MessageRepository $repository)
    {
        $messages = $repository->findAllFromUserToUser($user->getId(), $this->getUser()->getId());

        return $this->render('chat/chat.html.twig', [
            'messages' => $messages
        ]);
    }
}
