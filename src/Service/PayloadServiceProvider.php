<?php

declare(strict_types=1);

namespace Yansongda\Pay\Service;

use Yansongda\Pay\Contract\PayloadInterface;
use Yansongda\Pay\Contract\ServiceProviderInterface;
use Yansongda\Pay\Pay;
use Yansongda\Supports\Config;

class PayloadServiceProvider implements ServiceProviderInterface
{
    /**
     * @var array
     */
    private $payload = [];

    /**
     * {@inheritdoc}
     */
    public function prepare(array $data): void
    {
        $this->payload = array_replace_recursive($this->payload, $data['payload'] ?? []);
    }

    /**
     * {@inheritdoc}
     */
    public function register(Pay $pay): void
    {
        $service = $pay::make(Config::class, [
            'items' => $this->payload,
        ]);

        $pay::set(PayloadInterface::class, $service);
    }
}
