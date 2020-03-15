<?php
namespace Drupal\site_information\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\system\Form\SiteInformationForm;

/**
 * Configure site information settings for this site.
 */
class SiteApiKeyInformationForm extends SiteInformationForm
{
    /**
     * {@inheritdoc}
     */
    /**
     * Build Form for Site API key.
     * 
     * @param  array              $form.
     * @param  FormStateInterface $form_state.
     * 
     * @return Array  Return custom form.
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
      // Retrieve the system.site configuration.
      $site_config = $this->config('system.site');

      // Get the original form from the class we are extending.
      $form = parent::buildForm($form, $form_state);

      // Add a textfield to the site information form of siteapikey.
      $form['site_information']['site_api_key'] = [
        '#type' => 'textfield',
        '#title' => t('Site API Key'),
        '#default_value' => empty($site_config->get('siteapikey')) ? 'No API Key yet' : $site_config->get('siteapikey'),
        '#description' => '',
      ];
      if(!empty($site_config->get('siteapikey'))) {
        $form['actions']['submit']['#value'] = $this->t('Update Configuration');
      }
      return $form;
    }

    /**
     * Submit the form and set message.
     * 
     * @param  array              &$form.
     * @param  FormStateInterface $form_state.
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
      // save system.site.siteapikey.
      $this->config('system.site')
          ->set('siteapikey', $form_state->getValue('site_api_key'))
          ->save();

      // Passing the remaining values of the original form that we have extended,
      parent::submitForm($form, $form_state);
      $this->messenger()->addMessage($this->t('Site API Key has been saved. Updated API Key: ').$form_state->getValue('site_api_key'), 'status');
    }
}
