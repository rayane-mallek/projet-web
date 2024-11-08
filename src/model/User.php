<?php

/**
  * The closing ?> tag MUST be omitted from files containing only PHP.
  * @see https://www.php-fig.org/psr/psr-12/
  *
  * @author Rayane Mallek (mallekr@3il.fr)
*/

require_once File::build_path(array("model", "BaseModel.php"));

class User extends BaseModel
{
	private ?string $username;
    private ?string $email;
    private ?string $password;

    public function __construct(?string $username = null, ?string $email = null, ?string $password = null)
    {
        parent::__construct();

        if (! is_null($username) && ! is_null($email) && ! is_null($password)) {
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
        }
    }

    public function create()
    {
        $sql = "INSERT IGNORE INTO user (username, email, password) VALUES (:username, :email, :password)";
        $req = $this->pdo->prepare($sql);

        $req->execute([
            "username" => $this->username,
            "email" => $this->email,
            "password" => $this->password
        ]);
    }

    public function update()
    {
        $sql = "UPDATE user SET email = :email, password = :password WHERE username = :username";
        $req = $this->pdo->prepare($sql);

        $req->execute([
            "username" => $this->username,
            "email" => $this->email,
            "password" => $this->password
        ]);
    }

    public function getUserByUsername(string $username)
    {
        $sql = "SELECT * FROM user WHERE username = :username";
        $req = $this->pdo->prepare($sql);

        $req->execute([
            "username" => $username,
        ]);
    }

    public function getUserByEmail(string $email)
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $req = $this->pdo->prepare($sql);

        $req->execute([
            "email" => $email,
        ]);

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM user";
        $req = $this->pdo->prepare($sql);
        $req->execute();

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser(string $username)
    {
        $sql = "DELETE FROM user WHERE username = :username";
        $req = $this->pdo->prepare($sql);
        $req->execute(['username' => $username]);
    }
}