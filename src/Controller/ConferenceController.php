<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ConferenceRepository;
use Twig\Environment;
use App\Entity\Conference;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use App\Repository\CommentRepository;

final class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, ConferenceRepository $conferenceRepository): Response
    {

        return new Response($twig->render('conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]));
    }

    #[Route('/conference/{id}', name: 'conference')]
    public function show(Environment $twig, #[MapEntity] Conference $conference, CommentRepository $commentRepository): Response
    {
        return new Response($twig->render('conference/show.html.twig', [
            'conference' => $conference,
            'comments' => $commentRepository->findBy(['conference' => $conference], ['createdAt' => 'DESC']),
        ]));
    }
}
