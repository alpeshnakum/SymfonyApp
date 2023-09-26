<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    // In route there is no need to specify methods by default it will take needed method.
    #[Route('/movie/{movie_name}', name: 'app_movies', defaults:['movie_name' => null])]

    public function index($movie_name): Response
    {
        return $this->render('index.html.twig', [
            'movieTitle' => $movie_name
        ]);
    }

    #[Route('/old', name: 'app_old')]
    public function oldMethod(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MoviesController.php',
        ]);
    }
}
