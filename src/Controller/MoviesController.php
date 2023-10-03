<?php

namespace App\Controller;

use App\Entity\Movie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // In route there is no need to specify methods by default it will take needed method.
    #[Route('/movie/{movie_name}', name: 'app_movie', defaults: ['movie_name' => null])]

    public function index($movie_name): Response
    {
        return $this->render('index.html.twig', [
            "display" => "movie-detail",
            'movieTitle' => $movie_name
        ]);
    }

    // below is the systamic way to display data.
    #[Route('/movies', name: 'app_movies')]
    public function oldMethod(): Response
    {
        // findAll() -> SLEECT * FROM movies
        // find(11) -> SLEECT * FROM movies WHERE id=11
        // findBy(['title' => 'The Dark Knight', 'column-name' => 'value'], [id => 'DESC'])
        // findBy([], ['title' => 'DESC']) ==== sort by
        // count([]) ==== number of rows from the result
        // getClassName() ==== gives name/path of class(table name to be used)

        $repository = $this->em->getRepository(Movie::class); //Movie::class is name of entity
        $movies = $repository->findBy([], ['title' => 'DESC']);


        return $this->render('index.html.twig', [
            "display" => "movie-list",
            'movies_list' => $movies
        ]);
    }
}
