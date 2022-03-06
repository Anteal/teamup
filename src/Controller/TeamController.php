<?php

namespace App\Controller;

use App\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class TeamController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/teams", name="team_index")
     */
    public function index(): Response
    {
        $teams = $this->getDoctrine()->getRepository(Team::class)->findVisibleForUser($this->getUser());
        return $this->render('team/index.html.twig', [
            'teams' => $teams,
            'controller_name' => 'TeamController',
        ]);
    }
}
