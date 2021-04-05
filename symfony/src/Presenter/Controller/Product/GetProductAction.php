<?php
declare(strict_types=1);

namespace App\Presenter\Controller\Product;

use App\Application\AuthenticationService;
use App\Domain\WebToken;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetProductAction
{
    private $authenticationService;

    public function __construct(AuthenticationService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * @Route("/products", methods={"GET"})
     */
    public function __invoke(Request $request, WebToken $token): Response
    {
        if ($this->authenticationService->isValid($token)) {
            return new JsonResponse(
                [
                    'collection' => [
                        [
                            'identifier' => '330d2efc-7602-4f0c-b4eb-ff52df38048d',
                            'name' => 'Product 1'
                        ],
                        [
                            'identifier' => 'f67b4f73-b3a1-4db2-8711-6742c7b3f77a',
                            'name' => 'Product 2'
                        ],
                        [
                            'identifier' => '8fbb06f8-6c8c-4d0b-9f8e-88791f7b42f6',
                            'name' => 'Product 3'
                        ],
                        [
                            'identifier' => '7d19c00f-fdb9-4078-9032-5e56186b1583',
                            'name' => 'Product 4'
                        ],
                        [
                            'identifier' => '37cc81d7-ca41-4ef8-9df9-d81d9229ea98',
                            'name' => 'Product 5'
                        ],
                    ],
                    'metadata' => [
                        'total' => 5,
                    ],
                    'permissions' => [],
                ],
                200
            );
        }

        return new JsonResponse(['error' => ['message' => 'Authentication required']], 403);
    }
}
