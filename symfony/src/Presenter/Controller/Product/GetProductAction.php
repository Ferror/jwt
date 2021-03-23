<?php
declare(strict_types=1);

namespace App\Presenter\Controller\Product;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GetProductAction
{
    private const TOKEN = 'eyJhbGciOiJTSEE1MTIifQ==.eyJ1c2VyIjoxMjMsImV4cGlyZXNfYXQiOjE2MTY2MDAwMDB9.956e8e557ed84f93f90a5865586d38010d8e22e974384f3d5fee0764e0bb6ba9c5ef86432bcf4d1d5c26e058d26aa42fc1e10de884a62bedaa6269c706877d36';

    /**
     * @Route("/products", methods={"GET"})
     */
    public function __invoke(Request $request): Response
    {
        if ($request->get('token', '') === self::TOKEN) {
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
                    'meta' => [
                        'total' => 5,
                    ]
                ],
                200
            );
        }

        return new JsonResponse(['error' => ['message' => 'Authentication required']], 403);
    }
}
