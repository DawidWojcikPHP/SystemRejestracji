<?php

declare(strict_types=1);

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

// Zrobić działaący routing
// Zrobić php.ini z wyświetlaniem błędów
class Controller
{
    private const DEFAULT_URI = '/';
    
    private string $serverUri;
    
    public function __construct(private Request $request, private Model $model)
    {
        $this->serverUri = $request->getUri() ?? self::DEFAULT_URI;
        $this->serverUri = htmlentities($this->serverUri);
        $this->start($this->serverUri);

        if ($this->request->postParams() !== []) {
            $model->addUser();
        }
    }

    public function start(string $serverUri): void
    {
        switch ($serverUri) {
            case '/' :
                require __DIR__ . '/../public/index.php';
                break;
            case '/registration' :
                require __DIR__ . '/../public/registration.php';
                break;
            default:
                require __DIR__ . '/../public/index.php';
                break;
}
}    
}