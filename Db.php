<?php

class Db
{
    private static PDO $pdo;

    public const DB_DRIVER = 'mysql';
    public const DB_NAME = 'agenda-pdo';
    public const DB_HOST = 'localhost';
    public const DB_USER = 'root';
    public const DB_PASSWORD = '';

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance(): PDO
    {
        if (!isset(self::$pdo)) {
            self::$pdo = new PDO(
                self::DB_DRIVER . ':dbname=' . self::DB_NAME . ';host=' . self::DB_HOST,
                self::DB_USER,
                self::DB_PASSWORD
            );
        }

        return self::$pdo;
    }

    public static function storeEvento(Evento $e)
    {
        self::getInstance()->query("INSERT INTO evento (titulo, data) 
        VALUES ('$e->titulo', '$e->data')");
    }

    public static function getEvento(int $id): Evento
    {
        $res = self::getInstance()->query("SELECT * FROM evento WHERE id = $id");
        return $res->fetch(PDO::FETCH_CLASS, Evento::class);
    }

    public static function getEventosFromPeriod(int $timeStart, int $timeEnd): array
    {
        $res = self::getInstance()->query("SELECT * FROM evento WHERE 'data' >= $timeStart & 'data' <= $timeEnd");
        $events = $res->fetchAll(PDO::FETCH_CLASS);
        $arr = [];
        foreach ($events as $event) {
            $arr[] = new Evento($event->id, $event->titulo, $event->data, $event->feriado);
        }
        return $arr;
    }

    public static function destroyEvento(int $id)
    {
        self::getInstance()->query("DELETE FROM evento WHERE id = $id");
    }

    public static function updateEvento(int $id, Evento $evento)
    {
        self::getInstance()->query("UPDATE evento SET titulo = \"$evento->titulo\" WHERE id = $id");
    }
}
