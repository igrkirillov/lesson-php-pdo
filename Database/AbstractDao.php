<?php

namespace Database;

use PDO;

abstract class AbstractDao implements DatabaseWrapper
{
    private PDO $pdo;
    private string $table;

    public function __construct(string $table)
    {
        $this->table = $table;
        $this->pdo = new PDO("sqlite:ishop.sqlite");
    }


    public function insert(array $tableColumns, array $values): array
    {
        $params = array();
        foreach ($tableColumns as $column) {
            $params[] = ":$column";
        }
        $sql = "INSERT INTO {$this->table} ("
            . implode(",", $tableColumns)
            . ") VALUES ("
            . implode(",", $params)
            . ")";
        $stmt = $this->pdo->prepare($sql);
        for ($i = 0; $i < count($values); $i++) {
            $stmt->bindValue($params[$i], $values[$i]);
        }
        $stmt->execute();
        return array($this->pdo->lastInsertId());
    }

    public function update(int $id, array $values): array
    {
        $columns = array();
        $params = array();
        foreach ($values as $column => $value) {
            $columns[]= $column;
            $params[] = ":$column";
        }
        $sql = "UPDATE {$this->table} SET ";
        for ($i = 0; $i < count($columns); $i++) {
            $sql .= $columns[$i] . " = $params[$i]";
            if ($i < count($columns) - 1) {
                $sql .= ", ";
            }
        }
        $sql .= " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        for ($i = 0; $i < count($columns); $i++) {
            $stmt->bindValue($columns[$i], $values[$columns[$i]]);
        }
        $affectedRowsNumber = $stmt->execute();
        return array($affectedRowsNumber);
    }

    public function find(int $id): array
    {
        $sql = "SELECT * from {$this->table} WHERE id = :id ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE from {$this->table} WHERE id = :id ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}