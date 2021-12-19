<?php

namespace App\Models;

use Core\Model;
use Core\QueryBuilder;

use PDO;
use PDOException;

class UsersModel extends Model
{
    protected static string $table = 'users';

    private static string $columnID = 'id';
    private static string $columnFirstName = 'first_name';
    private static string $columnLastName = 'last_name';
    private static string $columnUsername = 'username';
    private static string $columnEmail = 'email';
    private static string $columnDescription = 'description';
    private static string $columnPassword = 'password';
    private static string $columnCountry = 'location_country';
    private static string $columnCity = 'location_city';
    private static string $columnAvatar = 'avatar';
    private static string $columnStatus = 'status';

    private int $id;
    private int $status;

    private string $email;
    private string $password;

    private string $firstName;
    private string $lastName;
    private string $username;
    private string $description;
    private string $country;
    private string $city;
    private string $avatar;

    public static function isUserExists(string $username, string $email): bool
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select('*')
                ->orWhere(
                    [
                        static::$columnUsername => $username,
                        static::$columnEmail => $email
                    ]
                );

            if ($query->first($query)) {
                return true; // If user exists
            }

            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function userRegistration(string $username, string $email, string $password): void
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $query = (new QueryBuilder())
                ->table('users')
                ->insert(
                    [
                        static::$columnUsername => $username,
                        static::$columnEmail => $email,
                        static::$columnPassword => $passwordHash,
                    ]
                );

            $query->execute($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return;
        }
    }

    public static function completeUserRegistration(array $userData): void
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->where([static::$columnID => $userData['userID']])
                ->update(
                    [
                        static::$columnFirstName => $userData['firstName'],
                        static::$columnLastName => $userData['lastName'],
                        static::$columnDescription => $userData['description'],
                        static::$columnCountry => $userData['country'],
                        static::$columnCity => $userData['city'],
                        static::$columnStatus => FULL_STATUS
                    ]
                );

            echo($query);
            $query->execute($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return;
        }
    }

    public function getUserBy(string $column, string $value)
    {
        try {
            $query = (new QueryBuilder())
                ->table(static::$table)
                ->select('*')
                ->where([$column=> $value]);

            $user = $query->first($query);

            $this->id = $user[static::$columnID];
            $this->firstName = $user[static::$columnFirstName];
            $this->lastName = $user[static::$columnLastName];
            $this->username = $user[static::$columnUsername];
            $this->email = $user[static::$columnEmail];
            $this->password = $user[static::$columnPassword];
            $this->description = $user[static::$columnDescription];
            $this->country = $user[static::$columnCountry];
            $this->city = $user[static::$columnCity];
            $this->avatar = $user[static::$columnAvatar];
            $this->status = $user[static::$columnStatus];

            return $this;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function createData(): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'username' => $this->username,
            'description' => $this->description,
            'country' => $this->country,
            'city' => $this->city
        ];
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getStatus(): int
    {
        return $this->status;
    }


    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}