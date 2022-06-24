<?php
/**
 * @link      https://www.gp.works
 * @copyright Copyright (c) 2019 Jamie Grisdale
 */

namespace pixelmachine\gpxcm\services;

use pixelmachine\gpxcm\GPxCM;
use pixelmachine\gpxcm\events\SubscribeEvent;

use Craft;
use craft\base\Component;
use yii\base\Event;

/**
 * ListService
 */
class ListService extends Component
{
    const EVENT_SUBSCRIBER_ADDED = 'subscriberAdded';

    // Public Methods
    // =========================================================================
    /*
     * @return mixed
     */
    public function subscribe(string $listId, string $email, string $fullName, array $additionalFields)
    {
        $response = [];

        $subscriber = array(
            'EmailAddress' => $email,
            'Name' => $fullName,
            'CustomFields' => $additionalFields,
            'Resubscribe' => true,
            'ConsentToTrack' => 'Unchanged'
        );

        if ($email !== null) {
            $response = GPxCM::getInstance()->campaignmonitor->addSubscriber($listId, $subscriber);
        }

        $eventName = self::EVENT_SUBSCRIBER_ADDED;

        $event = new SubscribeEvent([
            'subscriber' => $subscriber
        ]);
        $this->trigger($eventName, $event);

        return $response;
    }

}
