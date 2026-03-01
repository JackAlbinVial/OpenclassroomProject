<?php

class DBConnect
{
    private $pdo;

    public function __construct()
    {
        // Paramètres de connexion à récuperer dans le .env
        // pour eviter que les acces se retrouvent sur github

        $config = parse_ini_file('.env');

        $host = $config['DB_HOST'];
        $db   = $config['DB_NAME'];
        $user = $config['DB_USER'];
        $pass = $config['DB_PASS'];

        $dsn = "mysql:host=$host;dbname=$db;";

        //mise en forme des données sous forme de clé/valeur tableau associatif
        $option = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $option);
        } catch (\PDOException $e) {
            throw new \PDOException(
                "Erreur de connexion à la base de données.",
                $e->getMessage());
        }
    }

    public function getPDO()
    {
        return $this->pdo;
    }
}
