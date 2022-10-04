<?php
/**
 * @link      https://www.gp.works
 * @copyright Copyright (c) 2019 Jamie Grisdale
 */

namespace pixelmachine\gpxcm\controllers;

use pixelmachine\gpxcm\GPxCM;

use Craft;
use craft\web\Controller;


class UnsubscribeController extends Controller
{

    // Protected Properties
    // =========================================================================

    protected array|int|bool $allowAnonymous = ['index'];

    /**
     * @returns redirect or JSON
     */
    public function actionIndex()
    {
        $this->requirePostRequest();
        $request = Craft::$app->getRequest();

        // Fetch list id from hidden input
        $listId = $request->getRequiredBodyParam('listId') ? Craft::$app->security->validateData($request->post('listId')) : null;
        $redirect =  $request->getRequiredBodyParam('redirect') ? Craft::$app->security->validateData($request->post('redirect')) : null;
        $email = $request->getParam('email');

        $response = GPxCM::getInstance()->campaignmonitor->unsubSubscriber($listId, $email);

        return $request->getBodyParam('redirect') ? $this->redirectToPostedUrl() : $this->asJson($response);
    }

}