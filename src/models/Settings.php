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
use craft\helpers\App;

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
    public function behaviors(): array
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
    public function rules(): array
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
      return App::env('CM_STATUS');
    }

    /**
     * Retrieve parsed API Key
     *
     * @return string
     */
    public function getApiKey(): string
    {
      return App::env('CM_API_KEY');
    }

    /**
     * Retrieve parse Client Id
     *
     * @return string
     */
    public function getClientId(): string
    {
      return App::env('CM_CLIENT_ID');
    }

    /**
     * Retrieve List ID
     *
     * @return string
     */
    public function getListId($siteHandle=null): string
    {
      return App::env('CM_LIST_ID_'.$siteHandle);
    }
}

