<?php

namespace App\Entity;

class Author
{
    private $id;

    private $name;

    private $username;

    private $email;

    // Hay más info, ya veré qué pongo
/*
	
id	2
name	"Ervin Howell"
username	"Antonette"
email	"Shanna@melissa.tv"
address	
street	"Victor Plains"
suite	"Suite 879"
city	"Wisokyburgh"
zipcode	"90566-7771"
geo	
lat	"-43.9509"
lng	"-34.4618"
phone	"010-692-6593 x09125"
website	"anastasia.net"
company	
name	"Deckow-Crist"
catchPhrase	"Proactive didactic contingency"
bs	"synergize scalable supply-chains"
*/

    // En general este método no existiría, ya que el id estaría vinculado con la base de datos y Doctrine
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

}
