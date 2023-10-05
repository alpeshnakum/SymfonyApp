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
    #[Route('/movieTemp/{movie_name}', name: 'movie_detail', defaults: ['movie_name' => null])]

    public function fn_MoviesDetail($movie_name): Response
    {
        return $this->render('index.html.twig', [
            "display" => "movie-detail",
            'movieTitle' => $movie_name
        ]);
    }

    // below is the systamic way to display data.
    #[Route('/moviesTemp', name: 'move_list')]
    public function fn_MoviesList(): Response
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

    // ============================================================================

    #[Route('/movies', name: 'app_movies')]
    public function index(): Response
    {

        $repository = $this->em->getRepository(Movie::class);
        $movies = $repository->findAll();


        return $this->render('movies/index.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/movie/{id}', name: 'app_movie_detail', defaults: ['id' => null])]

    public function movieDetails($id): Response
    {
        $repository = $this->em->getRepository(Movie::class);
        $movie = $repository->find($id);

        return $this->render('/movies/show.html.twig', [
            'movie' => $movie
        ]);
    }
}
