<?php

namespace App\Controller;

use App\Repository\AuthorRepositoryInterface;
use App\Repository\PostEntryRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    protected PostEntryRepositoryInterface $postEntryRepository;
    protected AuthorRepositoryInterface $authorRepository;

    public function __construct(PostEntryRepositoryInterface $postEntryRepository,
    AuthorRepositoryInterface $authorRepository) {
        $this->postEntryRepository = $postEntryRepository;
        $this->authorRepository = $authorRepository;
   }
 
    #[Route('/post/{id}', name: 'post')]
    public function post(int $id = -1): Response
    {
        $postEntry = $this->postEntryRepository->find($id);

        // Como la instalación de encore me da problemas, hago una solución a medida
        $found = !empty($postEntry->getTitle());

        if ($found) 
        {
            $author = $this->authorRepository->find($postEntry->getUserId());
            return $this->render('post/index.html.twig', [
                'title' => $postEntry->getTitle(),
                'body' => $postEntry->getBody(),
                'username' => $author->getUsername(),
                'name' => $author->getName(),
                'email' => $author->getEmail(),
                'found' => true,
            ]);
        }
        else {
            return $this->render('post/index.html.twig', [
                'title' => '',
                'body' => '',
                'username' => '',
                'name' => '',
                'email' => '',
                'found' => false,
            ]);
        }
    }

    #[Route('/posts', name: 'posts')]
    public function posts(): Response
    {
        $postEntries = $this->postEntryRepository->findAll();
        $found = count($postEntries)>0;
        if ($found) 
        {
            return $this->render('post/list.html.twig', [
                'entries' => $postEntries,
                'found' => true,
            ]);
        }
        else {
            return $this->render('post/list.html.twig', [
                'entries' => '',
                'found' => false,
            ]);
        }
    }
}
