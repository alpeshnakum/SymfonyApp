<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    // In route there is no need to specify methods by default it will take needed method.
    #[Route('/movie/{movie_name}', name: 'app_movie', defaults:['movie_name' => null])]

    public function index($movie_name): Response
    {
        return $this->render('index.html.twig', [
            "display" => "movie-detail",
            'movieTitle' => $movie_name
        ]);
    }

    #[Route('/movies', name: 'app_movies')]
    public function oldMethod(): Response
    {
        $movies_list = ["Avanger: Endgame", "Inception", "Loki", "Black Widow"];
        return $this->render('index.html.twig', array(
            "display" => "movie-list",
            "movies_list" => $movies_list
        ));
    }
}
