<?php

namespace SegundoUso\AdBundle;

final class SegundoUsoAdEvents
{
    /**
     * The AD_CREATE_INITIALIZE event occurs when the ad create process is initialized.
     *
     * This event allows you to modify the default values of the user before binding the form.
     * The event listener method receives a FOS\UserBundle\Event\GetResponseUserEvent instance.
     */
    const AD_CREATE_INITIALIZE = 'seguso.ad_create.edit.initialize';

    /**
     * The AD_CREATE_SUCCESS event occurs when the ad create form is submitted successfully.
     *
     * This event allows you to set the response instead of using the default one.
     * The event listener method receives a FOS\UserBundle\Event\FormEvent instance.
     */
    const AD_CREATE_SUCCESS = 'seguso.ad_create.edit.success';

    /**
     * The AD_CREATE_COMPLETED event occurs after saving the ad in the ad create process.
     *
     * This event allows you to access the response which will be sent.
     * The event listener method receives a FOS\UserBundle\Event\FilterUserResponseEvent instance.
     */
    const AD_CREATE_COMPLETED = 'seguso.ad_create.edit.completed';
}