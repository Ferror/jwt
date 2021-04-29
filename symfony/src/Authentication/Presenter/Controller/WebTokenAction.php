<?php
declare(strict_types=1);

namespace Ferror\Authentication\Presenter\Controller;

use Ferror\Authentication\Application\WebTokenEncoder;
use Ferror\Authentication\Domain\Credentials;
use Ferror\Authentication\Domain\SignedWebTokenFactory;
use Ferror\Authentication\Domain\User\UserStorage;
use Ferror\Authentication\Framework\Response\ErrorResponse;
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

    public function __construct(UserStorage $userStorage, WebTokenEncoder $encoder, SignedWebTokenFactory $factory)
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
            //Save token to Redis & Database
            $token = $this->factory->create($user);

            return new JsonResponse(['token' => $token->serialize($this->encoder)], 200);
        }

        return new ErrorResponse('Invalid Credentials', 400);
    }
}
