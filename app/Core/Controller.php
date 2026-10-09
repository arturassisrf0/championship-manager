<?php
namespace App\Core;

abstract class Controller
{
    protected function view(string $name, array $data = []): void
    {
        extract($data);
        require __DIR__ . '/../views/' . $name . '.php';
    }
}

?>