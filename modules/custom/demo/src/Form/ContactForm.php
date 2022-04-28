<?php

namespace Drupal\demo\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


class ContactForm extends FormBase
{

    public function getFormId()
    {
        return 'contact_form';
    }


    public function buildForm(array $form, FormStateInterface $form_state)
    {
        $form = [];

        $form['name'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Name'),
            '#required' => true,
            '#default_value' => ' ',
            '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12']
        );
        $form['email'] = array(
            '#type' => 'email',
            '#title' => $this->t('Email'),
            '#required' => true,
            '#default_value' => ' ',
            '#placeholder' => 'Email',
            '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12'],
            '#element_attributes' => ['class' => 'email-demo'],
        );
        $form['comment'] = array(
            '#type' => 'textarea',
            '#maxlength' => 100,
            '#minlength' => 20,
            '#rows' => 4,
            '#size' => 64,
            '#required' => true,
            '#title_display' => true,
            '#placeholder' => 'Commentaire ...',
            '#description' => $this->t('Please add "Drupal" in this message '),
            '#wrapper_attributes' => ['class' => 'col-md-3 col-xs-6'],
            '#id' => 'comment'
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => 'Envoyer le commentaire',
            '#button_type' => 'primary',
            '#id' => 'btn-demo'
        );

        return $form;
    }

    public function validateForm(array &$form, FormStateInterface $formState)
    {
        // Check if name contains 3 chars
        if (strlen($formState->getValue('name')) < 3) {
            $formState->setErrorByName('name', 'Le nom doit avoir 3 caractères minimum.');
        }

        // Check if comment contains 50 chars
        if (strlen($formState->getValue('comment')) < 50) {
            $formState->setErrorByName('comment', 'Le comment doit avoir 50 caractères minimum.');
        }

    }


    public function submitForm(array &$form, FormStateInterface $form_state)
    {
//        dsm($form_state->getValues('email'));
        $email = $form_state->getValue('email');
        $msg = 'Votre Commentaire envoye avec succée. Vous avez reçu une confirmation à ' . $email;
        drupal_set_message($msg);

    }


}