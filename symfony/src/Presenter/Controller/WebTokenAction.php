<?php
declare(strict_types=1);

namespace App\Presenter\Controller;

use App\Application\WebTokenEncoder;
use App\Domain\Clock;
use App\Domain\Credentials;
use App\Domain\User\UserIdentifier;
use App\Domain\User\UserStorage;
use App\Domain\WebToken;
use App\Domain\WebToken\Algorithm;
use App\Domain\WebToken\WebTokenHeader;
use App\Domain\WebTokenFactory;
use App\Domain\WebTokenPayload;
use App\Framework\Response\ErrorResponse;
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
    private $userStorage;
    private $encoder;
    private $factory;

    public function __construct(UserStorage $userStorage, WebTokenEncoder $encoder, WebTokenFactory $factory)
    {
        $this->userStorage = $userStorage;
        $this->encoder = $encoder;
        $this->factory = $factory;
    }

    /**
     * @Route("/authentication", methods={"POST"})
     */
    public function __invoke(Request $request, Credentials $credentials): Response
    {
        $user = $this->userStorage->get($credentials->getLogin()->toString());

        if ($user->isPasswordValid($credentials->getPassword())) {
//            $header = ['alg' => 'SHA512'];
//            $payload = [
//                'user' => [
//                    'identifier' => 123,
//                ],
//                'created_at' => $this->clock->getTime(),
//                'expires_at' => $this->clock->getTime(),
//            ];
//            $signature = \hash_hmac($header['alg'], json_encode($header) . json_encode($payload), 'secret');
//
//            return new JsonResponse(
//                [
//                    'token' => $this->encoder->encode($header) . '.' . $this->encoder->encode($payload) . '.' . $signature,
//                ],
//                200
//            );

//            $header = new WebTokenHeader(Algorithm::sha512());
//            $payload = new WebTokenPayload($this->clock->getTime(), $this->clock->getTime(), $user->getIdentifier());
//            $token = new WebToken(
//                $header,
//                $payload,
//                new WebToken\WebTokenSignature(
//                    \hash_hmac(
//                        Algorithm::sha512()->toString(),
//                        json_encode($header->jsonSerialize()) . json_encode($payload->jsonSerialize()),
//                        'secret'
//                    )
//                )
//            );

            $token = $this->factory->create($user);

            return new JsonResponse(['token' => $token->serialize($this->encoder)], 200);
        }

        return new ErrorResponse('Invalid Credentials', 403);
    }
}
