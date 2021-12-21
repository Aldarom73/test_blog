<?php

namespace App\Controller\API;

use App\Repository\AuthorRepositoryInterface;
use App\Repository\PostEntryRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class APIPostController extends AbstractController
{
    private PostEntryRepositoryInterface $postEntryRepository;
    private AuthorRepositoryInterface $authorRepository;

    public function __construct(PostEntryRepositoryInterface $postEntryRepository,
    AuthorRepositoryInterface $authorRepository) {
        $this->postEntryRepository = $postEntryRepository;
        $this->authorRepository = $authorRepository;
   }
 
    #[Route('/api/add', name: 'api_add_post', methods: "POST")]
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Normalmente, los posts se harían por un usuario registrado y loggeado, por lo que
        // el id de usuario no se enviaría, sino que se cogería de la sesión.
        // Como no estoy añadiendo log in ni sesiones, lo dejo así.

        $userId = $data['userId'];
        $title = $data['title'];
        $body = $data['body'];

        // No permitimos nada vacío
        if (empty($userId) || empty($title) || empty($body)) 
        {
            throw new NotFoundHttpException("Faltan parámetros");
        }

        // También habría que comprobar que el usuario existe
        if (!$this->authorRepository->check($userId))
        {
            throw new NotFoundHttpException("El autor referenciado no existe");
        }

        if ($this->postEntryRepository->savePost($userId, $title, $body))
        {
            return new JsonResponse(['status' => 'Inserción correcta'], Response::HTTP_CREATED);
        }
        // else
        // Habría que ajustar el código de la respuesta al error concreto
        return new JsonResponse(['status' => 'Fallo en la inserción'], Response::HTTP_CONFLICT);
    }

    #[Route('/api/get/{id}', name: 'api_get_post', methods: "GET")]
    public function get($id): JsonResponse
    {
        $post = $this->postEntryRepository->find($id);
        // Normalmente eso ya nos devolvería los datos del usuario asociado, pero como no
        // estoy usando el sistema normal, lo hago a mano...

        if (empty($post->getTitle()))
        {
            throw new NotFoundHttpException("El post buscado no existe " . $id
        . " " . $post->getId() . " " . $post->getUserId() . " " . $post->getTitle() . 
    " ". $post->getBody());
        }

        // Si la base de datos es coherente, siempre habría un autor. Aún así podríamos comprobarlo
        // por seguridad, no sea que entre una consulta y otra se hubiera borrado...
        $author = $this->authorRepository->find($post->getUserId());

        $data = [
            'id' => $post->getId(),
            'userId' => $post->getUserId(),
            'title' => $post->getTitle(),
            'body' => $post->getBody(),
            'name' => $author->getName(),
            'username' => $author->getUsername(),
            'email' => $author->getEmail(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
