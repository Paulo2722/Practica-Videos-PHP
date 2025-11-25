<?php

namespace Core;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = '1234')
    {
        $host = $config['host'] ?? 'db';
        $database = $config['database'] ?? 'notes_app';
        $username = $config['username'] ?? 'root';
        $password = $config['password'] ?? '1234';

        $dsn = "mysql:host=$host;dbname=$database;charset=utf8";

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (!$result) {
            abort();
        }

        return $result;
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}