<?php
declare(strict_types=1);

namespace App\Framework\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

final class ErrorResponse extends JsonResponse
{
    public function __construct(string $message, int $status = 400)
    {
        parent::__construct(['error' => ['message' => $message]], $status, [], false);
    }
}
