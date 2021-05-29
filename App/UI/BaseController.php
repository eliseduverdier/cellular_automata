<?php

namespace App\UI;

class BaseController
{
    /**
     * @param Image|Text $class the App\UI\class that will render the content
     */
    public function __construct($class)
    {
        try {
            return new $class();
        } catch (\Throwable $e) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode([
                'error' => [
                    'message' => $e->getMessage(),
                    'file' => "{$e->getFile()}:{$e->getLine()}",
                ]
            ]);

            return;
        }
    }
}
