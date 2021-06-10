<?php
/**
 * @link      https://www.gp.works
 * @copyright Copyright (c) 2019 Jamie Grisdale
 */

namespace pixelmachine\gpxcm\models;

use pixelmachine\gpxcm\GPxCM;

use Craft;
use craft\base\Model;
use craft\behaviors\EnvAttributeParserBehavior;

/**
 * @author    Mark Reeves, Clearbold, LLC <hello@clearbold.com>
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $apiKey = null;
    /**
     * @var string
     */
    public $clientId = null;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'parser' => [
                'class' => EnvAttributeParserBehavior::class,
                'attributes' => [
                    'apiKey',
                    'clientId',
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['apiKey'], 'string'],
            [['apiKey'], 'required'],
            [['clientId'], 'string'],
            [['clientId'], 'required'],
        ];
    }

    /**
     * Retrieve status
     *
     * @return string
     */
    public function getStatus(): string
    {
    	$siteSettings = Craft::$app->globals->getSetByHandle('campaignMonitor')->fieldValues['campaignMonitorApi'][0];
        return $siteSettings['enable'];
    }

    /**
     * Retrieve parsed API Key
     *
     * @return string
     */
    public function getApiKey(): string
    {
    	$siteSettings = Craft::$app->globals->getSetByHandle('campaignMonitor')->fieldValues['campaignMonitorApi'][0];
        return $siteSettings['apiKey'];
    }

    /**
     * Retrieve parse Client Id
     *
     * @return string
     */
    public function getClientId(): string
    {
    	$siteSettings = Craft::$app->globals->getSetByHandle('campaignMonitor')->fieldValues['campaignMonitorApi'][0];
        return $siteSettings['clientId'];
    }

    /**
     * Retrieve List ID
     *
     * @return string
     */
    public function getListId(): string
    {
    	return Craft::$app->globals->getSetByHandle('campaignMonitor')->fieldValues['campaignMonitorListId'];
    }
}