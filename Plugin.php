<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsExample;

use System\Classes\PluginBase;
use Vdlp\Redirect\Classes\Contracts\RedirectManagerInterface;
use Vdlp\RedirectConditionsExample\Classes\IpAddressCondition;

class Plugin extends PluginBase
{
    public $require = [
        'Vdlp.Redirect',
        'Vdlp.RedirectConditions',
    ];

    public function pluginDetails(): array
    {
        return [
            'name' => 'Redirect Condition Extension: Example',
            'description' => 'A Redirect Condition implementation example plugin.',
            'author' => 'Van der Let & Partners',
            'icon' => 'icon-link',
            'homepage' => 'https://github.com/vdlp/oc-redirectconditionsexample-plugin',
        ];
    }

    public function boot(): void
    {
        /** @var RedirectManagerInterface $manager */
        $manager = resolve(RedirectManagerInterface::class);
        $manager->addCondition(IpAddressCondition::class, 1);
    }
}
