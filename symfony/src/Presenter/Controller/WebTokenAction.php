<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use App\Application\WebTokenEncoder;
use App\Domain\Clock;
use App\Domain\Credentials;
use App\Domain\User\UserStorage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Creates token for given login and password
 */
final class WebTokenAction extends AbstractController
{
    private $clock;
    private $userStorage;
    private $encoder;

    public function __construct(Clock $clock, UserStorage $userStorage, WebTokenEncoder $encoder)
    {
        $this->clock = $clock;
        $this->userStorage = $userStorage;
        $this->encoder = $encoder;
    }

    /**
     * @Route("/authentication", methods={"POST"})
     */
    public function __invoke(Request $request, Credentials $credentials): Response
    {
        $user = $this->userStorage->get($credentials->getLogin()->toString());

        if ($user->isPasswordValid($credentials->getPassword())) {
            $header = ['alg' => 'SHA512'];
            $payload = [
                'user' => [
                    'identifier' => 123,
                ],
                'created_at' => $this->clock->getTime(),
                'expires_at' => $this->clock->getTime(),
            ];
            $signature = hash_hmac($header['alg'], json_encode($header) . json_encode($payload), 'secret');

            return new JsonResponse(
                [
                    'token' => $this->encoder->encode($header) . '.' . $this->encoder->encode($payload) . '.' . $signature,
                ],
                200
            );
        }

        return new JsonResponse(['error' => ['message' => 'Invalid Credentials']], 403);
    }
}
