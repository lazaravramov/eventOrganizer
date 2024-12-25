<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/', name: 'home_page')]
    public function home(): Response
    {
        $number = random_int(0,10);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
    }

    #[Route('/lazar', name: 'lazar')]
    public function lazar(): Response
    {
        $this->userService->createUser("lazar@mail.com", "123321", "lazar");

        return new Response(
            '<html><body>Lucky number:Lazar</body></html>'
        );
    }
}