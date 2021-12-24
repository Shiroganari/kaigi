<?php

namespace Core;

class QueryBuilder extends Database
{
    private string $table = '';
    private string $select = '';
    private string $insert = '';
    private string $update = '';
    private string $where = '';
    private string $orWhere = '';

    private bool $max = false;
    private bool $like = false;
    private bool $delete = false;

    public function __toString(): string
    {
        $query = '';

        if ($this->select !== '') {
            if ($this->max) {
                $query = "SELECT MAX($this->select)";
            } else {
                $query = "SELECT $this->select";
            }

            $query .= " FROM $this->table";
            $query .= $this->where;
            $query .= $this->orWhere;
        } elseif ($this->insert !== '') {
            $query .= "INSERT INTO $this->table";
            $query .= $this->insert;
            $query .= $this->where;
            $query .= $this->orWhere;
        } elseif ($this->delete) {
            $query = "DELETE FROM $this->table";
            $query .= $this->where;
            $query .= $this->orWhere;
        } elseif($this->update !== '') {
            $query .= "UPDATE $this->table SET ";
            $query .= $this->update;
            $query .= $this->where;
            $query .= $this->orWhere;
        }

        return $query;
    }

    public function table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function select(string ...$select): self
    {
        $this->select = implode(', ', $select);
        return $this;
    }

    public function insert(array $insert): self
    {
        $insertQuery = '(';

        foreach ($insert as $key => $value) {
            $insertQuery .= $key . ', ';
        }

        $insertQuery = rtrim($insertQuery, ', ');
        $insertQuery .= ')';
        $insertQuery .= ' VALUES (';

        foreach ($insert as $value) {
            $insertQuery .= "'$value'" . ', ';
        }

        $insertQuery = rtrim($insertQuery, ', ');
        $insertQuery .= ')';
        $this->insert = $insertQuery;

        return $this;
    }

    public function update(array $update): self
    {
        $updateQuery = '';

        foreach ($update as $key => $value) {
            if ($value) {
                $updateQuery .= $key . ' = ' . "'$value'" . ', ';
            }
        }

        $updateQuery = rtrim($updateQuery, ', ');
        $this->update = $updateQuery;

        return $this;
    }

    public function where(array $where): self
    {
        $whereQuery = ' WHERE ';

        foreach ($where as $key => $value) {
            $whereQuery .= $key;

            if ($this->like) {
                $whereQuery .= ' LIKE ';
                $whereQuery .= "'%$value%'";
            } else {
                $whereQuery .= ' = ';
                $whereQuery .= "'$value'";
            }

            $whereQuery .= ' AND ';
        }

        $whereQuery = rtrim($whereQuery, ' AND ');
        $this->where = $whereQuery;

        return $this;
    }

    public function orWhere(array $orWhere): self
    {
        $orWhereQuery = ' WHERE ';

        foreach ($orWhere as $key => $value) {
            $orWhereQuery .= $key;

            if ($this->like) {
                $orWhereQuery .= ' LIKE ';
                $orWhereQuery .= "'%$value%'";
            } else {
                $orWhereQuery .= ' = ';
                $orWhereQuery .= "'$value'";
            }

            $orWhereQuery .= ' OR ';
        }

        $orWhereQuery = rtrim($orWhereQuery, ' OR ');
        $this->orWhere = $orWhereQuery;

        return $this;
    }

    public function max(): self
    {
        $this->max = true;
        return $this;
    }

    public function delete(): self
    {
        $this->delete = true;
        return $this;
    }

    public function like(): self
    {
        $this->like = true;
        return $this;
    }
}