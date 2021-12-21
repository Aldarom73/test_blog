<?php

namespace App\Repository;

interface AuthorRepositoryInterface 
{
    function find($id);
    function check($id);
}