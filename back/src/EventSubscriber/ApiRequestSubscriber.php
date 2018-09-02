<?php
namespace App\EventSubscriber;

use App\Controller\Api\ApiController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiRequestSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'convertJsonStringToArray',
        );
    }
    public function convertJsonStringToArray(FilterControllerEvent $event)
    {

        $controller = $event->getController();

        /* If it is a controller class, it comes in array format*/
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof ApiController) {

            $request = $event->getRequest();
            if ($request->getContentType() != 'json' || !$request->getContent()) {
                return;
            }
            $data = json_decode($request->getContent(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new BadRequestHttpException('invalid json body: ' . json_last_error_msg());
            }
            $request->request->replace(is_array($data) ? $data : array());
        }
    }

}
