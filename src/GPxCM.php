<?php
/**
 * @link      https://www.gp.works
 * @copyright Copyright (c) 2019 Jamie Grisdale
 */

namespace gp\gpxcm;

use gp\gpxcm\services\CampaignMonitorService;
use gp\gpxcm\models\Settings;


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
    public $hasCpSettings = false;
    public static $plugin;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->setComponents([
            'campaignmonitor' => \gp\gpxcm\services\CampaignMonitorService::class,
            'cmListService' =>  \gp\gpxcm\services\ListService::class
        ]);

        Craft::info(
            Craft::t(
                'gpx-cm',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }
    protected function createSettingsModel()
    {
        return new \gp\gpxcm\models\Settings();
    }
}
