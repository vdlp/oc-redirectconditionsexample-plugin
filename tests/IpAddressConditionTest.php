<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsExample\Tests;

use PluginTestCase;
use Vdlp\RedirectConditions\Models\ConditionParameter;
use Vdlp\RedirectConditions\Tests\Factories\RedirectRuleFactory;
use Vdlp\RedirectConditionsExample\Classes\IpAddressCondition;

class IpAddressConditionTest extends PluginTestCase
{
    /**
     * @throws \PHPUnit_Framework_AssertionFailedError
     */
    public function testLocalhost(): void
    {
        /** @var IpAddressCondition $condition */
        $condition = resolve(IpAddressCondition::class);

        ConditionParameter::create([
            'redirect_id' => 1,
            'condition_code' => $condition->getCode(),
            'is_enabled' => date('Y-m-d H:i:s'),
            'parameters' => [
                'ip_addresses' => [
                    '127.0.0.1',
                ],
            ],
        ]);

        $rule = RedirectRuleFactory::createRedirectRule();

        self::assertTrue($condition->passes($rule, '/from/url'));
    }
}
