<?php

namespace app\core;

use Exception;

class Database
{

    public \PDO $pdo;

    public function __construct(array $config)
    {
        $dsn =  $config['dns'] ?? '';
        $username =  $config['username'] ?? '';
        $password = $config['password'] ?? '';

        try {
            $this->pdo = new \PDO($dsn, $username, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            echo "BD: CONECTADO!" . "\n";
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function applyMigrations()
    {
        // echo "Running migrations\n";
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $files = scandir(Application::$ROOT_DIR . "/migrations");
        $toAppliedMigrations = $this->getAppliedMigrations();
        foreach ($toAppliedMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new  $className();
            echo "Appliying migrations $migration\n";
            $instance->up();
            echo "Appliying migrations $migration\n";

            $newMigrations[] = $migration;
        }
        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            echo "Al migrations has been applied";
        }
    }

    public function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS `registro`.`migrations` ( `id` INT NOT NULL AUTO_INCREMENT , `migration` VARCHAR(255) NOT NULL , `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; ");
    }

    public function getAppliedMigrations()
    {
        $sql = "SELECT migration FROM migrations";
        $stm =  $this->pdo->prepare($sql);
        $stm->execute();

        return $stm->fetchAll(\PDO::FETCH_COLUMN);
    }
    public function saveMigrations(array $newMigrations)
    {
        $values = implode(',',array_map(fn($m) => "('$m')", $newMigrations));
        $stm = $this->pdo->prepare("INSERT INTO (migrations) VALUES $values");
    }
}
