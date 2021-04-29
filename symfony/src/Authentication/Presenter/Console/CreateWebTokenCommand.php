<?php
declare(strict_types=1);

namespace Ferror\Authentication\Presenter\Console;

use Ferror\Authentication\Domain\Clock;
use Ferror\Authentication\Infrastructure\Base64\Encoder as Base64Encoder;
use Ferror\Authentication\Infrastructure\Json\Encoder as JsonEncoder;
use Ferror\Authentication\Infrastructure\Memory\MemoryEncoder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateWebTokenCommand extends Command
{
    private $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
        parent::__construct('jwt:create');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
//        $header = ['alg' => 'SHA512'];
//        $payload = [
//            'user' => [
//                'identifier' => 123,
//            ],
//            'created_at' => $this->clock->getTime(),
//            'expires_at' => $this->clock->getTime(),
//        ];
//        $signature = hash_hmac($header['alg'], json_encode($header) . json_encode($payload), 'secret');
//        $output->writeln($this->encode($header) . '.' . $this->encode($payload) . '.' . $signature,);

        return Command::SUCCESS;
    }

    private function encode($data): string
    {
        $encoder = new JsonEncoder(new Base64Encoder(new MemoryEncoder()));

        return $encoder->encode($data);
    }
}
