<?php
declare(strict_types=1);

namespace App\Framework\Response;

use App\Domain\Collection;
use Symfony\Component\HttpFoundation\JsonResponse;

final class ResourceCollectionResponse extends JsonResponse
{
    public function __construct(Collection $collection)
    {
        parent::__construct($collection->jsonSerialize(), 200, ['Content-Type' => 'application/json'], false);
    }
}
