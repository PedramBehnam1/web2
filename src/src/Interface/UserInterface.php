<?php

namespace App\Model;


interface UserInterface
{
    public function getCreatedUsername();

    public function setCreatedUsername($userName);

    public function getUpdatedUsername();

    public function setUpdatedUsername($userName);

}