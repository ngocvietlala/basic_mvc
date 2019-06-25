<?php


class View
{
    public function __construct()
    {
    }

    public function render($name, $compact = [])
    {
        foreach ($compact as $key => $value) {
            ${$key} = $value;
        }

        include __DIR__.'/../app/views/layout/header.php';
        require_once __DIR__.'/../app/views/' . $name . '.php';
        include __DIR__.'/../app/views/layout/footer.php';
    }
}