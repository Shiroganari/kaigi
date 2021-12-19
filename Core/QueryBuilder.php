<?php

namespace Core;

class QueryBuilder extends Database
{
    private array $table = [];
    private array $select = [];
    private array $insert = [];
    private array $where = [];
    private array $update = [];
    private array $orWhere = [];
    private bool $delete = false;
    private bool $isMax = false;

    public function __toString(): string
    {
        $query = '';
        $where = '';
        $orWhere = '';

        if ($this->where !== []) {
            $where = ' WHERE ';

            foreach ($this->where as $key => $value) {
                $where .= $key . ' = ' . "'$value'" . ' AND ';
            }

            $where = rtrim($where, ' AND ');
        } elseif ($this->orWhere !== []) {
            $orWhere = ' WHERE ';

            foreach ($this->orWhere as $key => $value) {
                $orWhere .= $key . ' = ' . "'$value'" . ' OR ';
            }

            $orWhere = rtrim($orWhere, ' OR ');
        }

        if ($this->select !== []) {
            if ($this->isMax) {
                $query = 'SELECT MAX(' . implode(', ', $this->select) . ')';
            } else {
                $query = 'SELECT ' . implode(', ', $this->select);
            }

            $query .= ' FROM ' . implode(', ', $this->table);
            $query .= $where;
            $query .= $orWhere;
        } elseif ($this->insert !== []) {
            $query .= 'INSERT INTO ' . implode(', ', $this->table) . '(';

            foreach ($this->insert as $key => $value) {
                $query .= $key . ', ';
            }

            $query = rtrim($query, ', ');
            $query .= ')';
            $query .= ' VALUES (';

            foreach ($this->insert as $value) {
                $query .= "'$value'" . ', ';
            }

            $query = rtrim($query, ', ');
            $query .= ')';
        } elseif ($this->delete) {
            $query = 'DELETE FROM ' . implode(', ', $this->table);
            $query .= $where;
            $query .= $orWhere;
        } elseif($this->update !== []) {
            $query .= 'UPDATE ' . implode(', ', $this->table) . ' SET ';

            foreach ($this->update as $key => $value) {
                if ($value) {
                    $query .= $key . ' = ' . "'$value'" . ', ';
                }
            }

            $query = rtrim($query, ', ');

            $query .= $where;
            $query .= $orWhere;
        }

        return $query;
    }

    public function table(string $table): self
    {
        $this->table[] = $table;
        return $this;
    }

    public function select(string ...$select): self
    {
        $this->select = $select;
        return $this;
    }

    public function insert(array $insert): self
    {
        foreach ($insert as $key => $value) {
            $this->insert[$key] = $value;
        }

        return $this;
    }

    public function update(array $update): self
    {
        foreach ($update as $key => $value) {
            $this->update[$key] = $value;
        }

        return $this;
    }

    public function where(array $where): self
    {
        foreach ($where as $key => $value) {
            $this->where[$key] = $value;
        }

        return $this;
    }

    public function orWhere(array $orWhere): self
    {
        foreach ($orWhere as $key => $value) {
            $this->orWhere[$key] = $value;
        }

        return $this;
    }

    public function setParams(array $params): self
    {
        foreach ($params as $key => $value) {
            $this->params[$key] = $value;
        }

        return $this;
    }

    public function max()
    {
        $this->isMax = true;
        return $this;
    }

    public function delete()
    {
        $this->delete = true;
        return $this;
    }
}