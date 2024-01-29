<?php
/**
 * @link      https://www.gp.works
 * @copyright Copyright (c) 2019 Jamie Grisdale
 */

namespace pixelmachine\gpxcm;

use pixelmachine\gpxcm\services\CampaignMonitorService;
use pixelmachine\gpxcm\models\Settings;
use pixelmachine\gpxcm\services\ListService;

use Craft;
use craft\base\Plugin;
use craft\base\Model;

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
            'campaignmonitor' => CampaignMonitorService::class,
            'cmListService' =>  ListService::class
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
    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }
}
