<?php

namespace Drupal\site_information\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Dynamic route events.
 */
class SiteApiKeyRouteSubscriber extends RouteSubscriberBase
{
  /**
   * Alter form for the system.site_information_settings route.
   * To Drupal\site_information\Form\SiteApiKeyInformationForm.
   * 
   * @param  RouteCollection $collection.
   */
  protected function alterRoutes(RouteCollection $collection) {
    if($route = $collection->get('system.site_information_settings')) {
        $route->setDefault('_form', 'Drupal\site_information\Form\SiteApiKeyInformationForm');
    }
  }
}
