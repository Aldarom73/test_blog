<?php

namespace App\Repository;

use App\Entity\Author;
use Exception;

/* Lo normal sería usar algún tipo de base de datos, para este tipo de web alguna SQL, con Doctrine 
 * y todas sus ventajas. Como en este caso es un sustituto, haré un reemplazo.
 */
//use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Doctrine\Persistence\ManagerRegistry;

/*
 * @method Author|null find($id, $lockMode = null, $lockVersion = null)
 * @method Author|null findOneBy(array $criteria, array $orderBy = null)
 * @method Author[]    findAll()
 * @method Author[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthorRepository implements AuthorRepositoryInterface//extends ServiceEntityRepository
{
    /*
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }
    */

    public function __construct()
    {
    }

    /**
     * @return Author Returns an Author object
     */
    public function find($id) 
    {
        $author = new Author();
        
        try 
        {
            $url = 'https://jsonplaceholder.typicode.com/users/' . $id;
            $jsondata = file_get_contents($url); 
            $obj = json_decode($jsondata, true);
            //    var_dump($obj);
            //    echo $obj[1]->title;
            $author->setId($id);
            $author->setName($obj['name']);
            $author->setUsername($obj['username']);
            $author->setEmail($obj['email']);
            $author->setName($obj['name']);
        } catch (Exception $e) 
        {
            // Hacer el tratamiento de la excepción que queramos
            $author->setId($id);
        } finally 
        {
            return $author;
        }

    }

    /**
     * @return bool 
     */
    public function check($id) 
    {
        $exists = false;
        try 
        {
            $url = 'https://jsonplaceholder.typicode.com/users/' . $id;
            $jsondata = file_get_contents($url); 
            $obj = json_decode($jsondata, true);
            $exists = !empty($obj['id']);
        } catch (Exception $e) 
        {
            // Hacer el tratamiento de la excepción que queramos
        } finally 
        {
            return $exists;
        }

    }
}
