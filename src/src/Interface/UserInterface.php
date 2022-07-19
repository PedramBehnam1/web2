<?php

 namespace App\Interface;


interface UserInterface
{
    public function getCreatedUsername();

    public function setCreatedUsername($userName);

    public function getUpdatedUsername();

    public function setUpdatedUsername($userName);

}