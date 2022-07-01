<?php

namespace App\Interface;


interface TimeInterface
{
    public function getCreatedAt();

    public function setCreatedAt($dateTime);

    public function getupdatedAt();

    public function setupdatedAt($dateTime);

}

