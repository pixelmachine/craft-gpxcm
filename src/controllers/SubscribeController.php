<?php
/**
 * @link      https://www.gp.works
 * @copyright Copyright (c) 2019 Jamie Grisdale
 */

namespace pixelmachine\gpxcm\controllers;

use pixelmachine\gpxcm\GPxCM;

use Craft;
use craft\web\Controller;
use craft\web\Response;


class SubscribeController extends Controller
{

    // Protected Properties
    // =========================================================================

    protected array|int|bool $allowAnonymous = ['index'];

    /**
     * @returns redirect or JSON
     */
    public function actionIndex(): string|Response
    {
        $this->requirePostRequest();
        $request = Craft::$app->getRequest();

        // Fetch list id from hidden input
        $listId = $request->getRequiredBodyParam('listId') ? Craft::$app->security->validateData($request->post('listId')) : null;
        $redirect =  $request->getParam('redirect') ? Craft::$app->security->validateData($request->post('redirect')) : null;

        $additionalFields = array();
        $email = $request->getParam('email');
        $fullName = '';
        if ($request->getParam('fullname') !== null)
            $fullName = $request->getParam('fullname');
        if ($request->getParam('firstname') !== null)
            $fullName = $request->getParam('firstname');
        if ($request->getParam('lastname') !== null)
            $fullName .= ' ' . $request->getParam('lastname');

        if ($request->getParam('fields') !== null)
        {
            foreach($request->getParam('fields') as $key => $value) {
                if ($key != 'email' && $key != 'firstname' && $key != 'lastname' && $key != 'fullname')
                {
                    $additionalFields[] = array(
                        'Key' => $key,
                        'Value' => $value
                    );
                }
            }
        }

        // $subscriber = array(
        //     'EmailAddress' => $email,
        //     'Name' => $fullName,
        //     'CustomFields' => $additionalFields,
        //     'Resubscribe' => true
        // );

        // if ($request->getParam('email') !== null) {
        //     $response = CmLists::getInstance()->campaignmonitor->addSubscriber($listId, $subscriber);
        // }

        $response = GPxCM::getInstance()->cmListService->subscribe($listId, $email, $fullName, $additionalFields);

        return $request->getBodyParam('redirect') ? $this->redirectToPostedUrl() : $this->asJson($response);
    }

}
