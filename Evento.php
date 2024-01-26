<?php

class Evento
{
    public int $id;
    public string $titulo;
    public int $data;

    public function __construct(int $id, string $titulo, int $data)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->data = $data;
    }
}
