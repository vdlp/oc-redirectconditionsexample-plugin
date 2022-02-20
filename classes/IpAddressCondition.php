<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsExample\Classes;

use Illuminate\Http\Request;
use Vdlp\Redirect\Classes\RedirectRule;
use Vdlp\RedirectConditions\Classes\Condition;

class IpAddressCondition extends Condition
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getCode(): string
    {
        return 'vdlp_example_ip';
    }

    public function getDescription(): string
    {
        return 'IP address';
    }

    public function getExplanation(): string
    {
        return 'Specify for which ip(s) this redirect rule applies.';
    }

    public function passes(RedirectRule $rule, string $requestUri): bool
    {
        $parameters = $this->getParameters($rule->getId());

        $ipAddresses = $parameters['ip_addresses'] ?? [];

        if (empty($ipAddresses)) {
            return true;
        }

        if (in_array($this->request->ip(), $ipAddresses, true)) {
            return true;
        }

        return false;
    }

    public function getFormConfig(): array
    {
        return [
            'ip_addresses' => [
                'tab' => self::TAB_NAME,
                'label' => 'A list of IP addresses.',
                'type' => 'taglist',
                'mode' => 'array',
                'separator' => 'space',
                'span' => 'left',
            ],
        ];
    }
}
