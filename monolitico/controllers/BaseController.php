<?php
require_once __DIR__ . '/AbstractController.php';

class BaseController extends AbstractController
{
    public function index(): void
    {
        http_response_code(204);
    }
}
