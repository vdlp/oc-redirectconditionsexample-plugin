<?php

declare(strict_types=1);

namespace Vdlp\RedirectConditionsExample;

use System\Classes\PluginBase;
use Vdlp\Redirect\Classes\Contracts\RedirectManagerInterface;
use Vdlp\RedirectConditionsExample\Classes\IpAddressCondition;

/**
 * Class Plugin
 *
 * @package Vdlp\RedirectConditionsExample
 */
class Plugin extends PluginBase
{
    /**
     * {@inheritdoc}
     */
    public $require = [
        'Vdlp.Redirect',
        'Vdlp.RedirectConditions',
    ];

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * {@inheritdoc}
     */
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

    /** @noinspection PhpMissingParentCallCommonInspection */

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        /** @var RedirectManagerInterface $manager */
        $manager = resolve(RedirectManagerInterface::class);
        $manager->addCondition(IpAddressCondition::class, 1);
    }
}
