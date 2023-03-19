<?php

declare(strict_types=1);

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

class Model
{
    private const MIN_CHARS = 3;
    private const MAX_CHARS = 25;

    private $conn;

    public function __construct(private array $env, private Request $request)
    {
        try {
            $this->conn = new \PDO(
                'mysql:' . $env['DB_NAME'] . ';' . $env['DB_HOST'],
                $env['DB_USER'],
                $env['DB_PASSWORD']);
        } catch (\Throwable) {
        
        }
    
    }

    public function addUser(): void
    {
        try {
            $query = $this->conn->prepare("INSERT INTO users (login, password, email) VALUES  (:login, :password, :email)");

            $query->bindParam(":login", $login);
            $query->bindParam(":password", $password);
            $query->bindParam(":email", $email);

            $login = $this->validateLogin();
            $password = $this->validatePassword();
            $email = $this->validateEmail();

            $query->execute();
            } catch (\Throwable) {
            
        }
    }

    private function validatePassword(): string
    {

    $repeatPassword = $this->request->postParams()['password'];
    $password = $this->request->postParams()['repeatPassword']; 

    if (
        isset($password)
        && $password === $repeatPassword
        && strlen($password) >= self::MIN_CHARS
        && strlen($password) <= self::MAX_CHARS
        ) {
     return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
}

private function validateLogin(): string
{

$login = $this->request->postParams()['login']; 
$allowedChars = [' ', '_', '-'];

if (
    isset($login)
    && strlen($login) >= self::MIN_CHARS
    && strlen($login) <= self::MAX_CHARS
    && ctype_alnum(str_replace($allowedChars, '', $login))
    ) {
    return $login;
}
}

private function validateEmail(): string
    {

    $email = $this->request->postParams()['email']; 
    $safeEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $checkedEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

    if (
        isset($email)
        && $safeEmail
        && $email === $safeEmail
        && $checkedEmail
        ) {
        return $email;
    }
}
}