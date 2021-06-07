<?php

namespace Yansongda\Pay\Tests\Plugin\Alipay\Fund;

use PHPUnit\Framework\TestCase;
use Yansongda\Pay\Parser\ResponseParser;
use Yansongda\Pay\Plugin\Alipay\Fund\TransPagePayPlugin;
use Yansongda\Pay\Rocket;

class TransPagePayPluginTest extends TestCase
{
    public function testNormal()
    {
        $rocket = new Rocket();
        $rocket->setParams([]);

        $plugin = new TransPagePayPlugin();

        $result = $plugin->assembly($rocket, function ($rocket) { return $rocket; });

        self::assertEquals(ResponseParser::class, $result->getDirection());
        self::assertStringContainsString('alipay.fund.trans.page.pay', $result->getPayload()->toJson());
    }
}
