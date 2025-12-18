<?php

class Message
{
    public int $iduser;
    public string $name;
    public string $bericht;

    public function __construct(int $iduser, string $name, string $bericht)
    {
        $this->iduser = $iduser;
        $this->name = $name;
        $this->bericht = $bericht;
    }
}
