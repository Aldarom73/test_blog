<?php

namespace App\Repository;

use App\Entity\PostEntry;
use Exception;

class PostEntryRepository implements PostEntryRepositoryInterface
{
    public function __construct()
    {
    }

    /**
     * @return PostEntry Returns a PostEntry object
     */
    public function find($id) 
    {
        $postEntry = new PostEntry();
        
        try 
        {
            $url = 'https://jsonplaceholder.typicode.com/posts/' . $id;
            $jsondata = file_get_contents($url); 
            $obj = json_decode($jsondata, true);
            //    var_dump($obj);
            //    echo $obj[1]->title;
            $postEntry->setId($id);
            $postEntry->setTitle($obj['title']);
            $postEntry->setUserId($obj['userId']);
            $postEntry->setBody($obj['body']);
        } catch (Exception $e) 
        {
            // Hacer el tratamiento de la excepción que queramos
            $postEntry->setId($id);
        } finally 
        {
            return $postEntry;
        }
    }

    /**
     * @return PostEntry[] Returns an array of PostEntry objects
     */
    public function findAll() 
    {
        // Lo habitual es hacer una consulta y devolver un pequeño número de entradas
        $postEntries[] = new PostEntry;
        
        try 
        {
            $url = 'https://jsonplaceholder.typicode.com/posts';
            $jsondata = file_get_contents($url); 
            $obj = json_decode($jsondata, true);
            
            for ($i=0; $i < count($obj); $i++)
            {
                $postEntry = new PostEntry();
            
                $postEntry->setId($obj[$i]['id']);
                $postEntry->setUserId($obj[$i]['userId']);
                $postEntry->setTitle($obj[$i]['title']);
                $postEntry->setBody($obj[$i]['body']);
    
                $postEntries[$i] = $postEntry;
            }

        } catch (Exception $e) 
        {
            // Hacer el tratamiento de la excepción que queramos
        } finally 
        {
            return $postEntries;
        }
    }

    public function savePost($userId, $title, $body): bool
    {
        /* 
         * El user id se ha comprobado antes
         * tanto title como body no están vacíos
         * En una base de datos, el Id del nuevo post se obtendría automáticamente
         * Simplemente habría que comprobar que el resultado fuera correcto, y previamente hacer un
         * escapado de las cadenas de texto para evitar una potencial inyección de código y comprobación de
         * longitudes y tipos en los datos.
         */

        // Uso esto para recortar las cadenas.
        $postEntry = new PostEntry();
        $postEntry->setUserId($userId);
        $postEntry->setTitle($title);
        $postEntry->setBody($body);

        // Esto en principio no es de this, sino de PDO
        // Habría que comprobar que este método es seguro ante inyección de código.
        $stmt = $this->prepare('INSERT (userId, title, body) IN TABLA_DE_POSTS values (:userId, :title, :body)');

        /*
         * Esto ejecutaría realmente el insert. Obtendríamos el valor del id del nuevo post, y podríamos devolverlo
         * al peticionario.
        $stmt->execute([ 'userId' => $postEntry->getUserId(), 'title' => $postEntry->getTitle(),
        'body' => $postEntry->getBody() ]);
        */

        // Otra opción es con los managers, hacer un persist y un flush.

        return true;
    }

    private function prepare($statement) 
    {
        // No hace nada, esto sería cosa de la base de datos
    }

    /**
     * @return bool 
     */
    public function check($id) 
    {
        $exists = false;
        try 
        {
            $url = 'https://jsonplaceholder.typicode.com/posts/' . $id;
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
