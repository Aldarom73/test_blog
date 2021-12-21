<?php

namespace App\Repository;

interface PostEntryRepositoryInterface 
{
    function find($id);
    function findAll();
    function savePost($userId, $title, $body): bool;
}