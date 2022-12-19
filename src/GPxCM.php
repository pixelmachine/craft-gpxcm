<?php
/**
 * @link      https://www.gp.works
 * @copyright Copyright (c) 2019 Jamie Grisdale
 */

namespace pixelmachine\gpxcm;

use pixelmachine\gpxcm\services\CampaignMonitorService;
use pixelmachine\gpxcm\models\Settings;


use Craft;
use craft\base\Plugin;

/**
 * Campaign Monitor Service is an API wrapper and settings manager for Campaign Monitor plugins for Craft.
 *
 * @author Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since 1.0.0
 */
class GPxCM extends Plugin
{
    // public bool $hasCpSettings = false;
    public static $plugin;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->setComponents([
            'campaignmonitor' => \pixelmachine\gpxcm\services\CampaignMonitorService::class,
            'cmListService' =>  \pixelmachine\gpxcm\services\ListService::class
        ]);

        Craft::info(
            Craft::t(
                'gpxcm',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
    protected function createSettingsModel(): ?\craft\base\Model
    {
        return new \pixelmachine\gpxcm\models\Settings();
    }
}
