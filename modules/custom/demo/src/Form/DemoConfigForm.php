<?php

namespace Drupal\demo\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\demo\ContactEvent;

class DemoConfigForm extends ConfigFormBase
{

         public function getFormId() {
            return 'Demo_Config_Form';
    }
    public function buildForm(array $form, FormStateInterface $form_state) {

        $config = $this->config('demo.Config_Form');

        $form['store_name'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Store name'),
            '#default_value' => $config->get('store_name'),
        );

        $form['opening_time'] = array (
            '#type' => 'textarea',
            '#title' => $this->t('Opening time'),
            '#default_value' => $config->get('opening_time'),
        );

        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {

        parent::submitForm($form, $form_state);

        $config = $this->config('demo.Config_Form');

        $config->set('store name', $form_state->getValue('store_name'))
            ->set('message', $form_state->getValue('opening_time'));


        $dispatcher = \Drupal::service('event_dispatcher');
        $e = new ContactEvent($config);
        $event= $dispatcher->dispatch('contact_Form.save', $e);

        $data = $event->getConfig()->get();
        $config->merge($data);

        $config->save();

    }


    protected function getEditableConfigNames() {

        return array (
            'demo.Config_Form'
        );
    }

}