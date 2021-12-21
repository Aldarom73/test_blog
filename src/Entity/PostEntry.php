<?php

namespace App\Entity;


class PostEntry
{
    private $id;

    // Normalmente esto ya sería un objeto de la clase Author, con el id aquí dado
    private $userId;

    private $title;

    private $body;

    // En general este método no existiría, ya que el id estaría vinculado con la base de datos y Doctrine
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        // Habría que configurar la longitud según la base de datos, y dejarla como una constante o así
        $this->title = substr($title, 0, 100);

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        // Habría que configurar la longitud según la base de datos, y dejarla como una constante o así
        $this->body = substr($body, 0, 1000);

        return $this;
    }

}
