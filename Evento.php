<?php

class Evento
{
    public int $id;
    public string $titulo;
    public int $data;
    public int $feriado;

    public function __construct(int $id, string $titulo, int $data, bool $feriado)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->data = $data;
        $this->feriado = $feriado;
    }
}
