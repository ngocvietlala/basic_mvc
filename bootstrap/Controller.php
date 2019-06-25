<?php


class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function responseSuccess(array $data, int $code = 200)
    {
        header('Content-Type: application/json');
        http_response_code ($code);
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    public function responseMethodNotAllowed(string $message = 'method not allowed', int $code = 405)
    {
        http_response_code($code);
        echo $message;
        exit;
    }

    public function responseCreated(array $data, int $code = 201)
    {
        header('Content-Type: application/json');
        http_response_code ($code);
        echo json_encode($data, JSON_PRETTY_PRINT);
        exit;
    }

    public function responseServerError(string $message = 'server error', int $code = 500)
    {
        header('Content-Type: application/json');
        http_response_code ($code);
        echo $message;
        exit;
    }
}