<?php

namespace App\Controller;

use App\Repository\AuthorRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{

    protected AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository) {
        $this->authorRepository = $authorRepository;
   }
 
    #[Route('/author/{id}', name: 'author')]
    public function index(int $id= -1 ): Response
    {

        $author = $this->authorRepository->find($id);

        // Como la instalación de encore me da problemas, hago una solución a medida
        $found = !empty($author->getName());

        return $this->render('author/index.html.twig', [
            'name' => $author->getName(),
            'username' => $author->getUsername(),
            'email' => $author->getEmail(),
            'found' => $found,
        ]);
    }
}
