<?php
/**
 * Created by PhpStorm.
 * User: maxim
 * Date: 26.05.18
 * Time: 21:23
 */

namespace shop\services;


use shop\forms\ContactForm;
use yii\mail\MailerInterface;

class ContactService
{

    private $adminEmail;
    private $mailer;


    public function __construct($adminEmail, MailerInterface $mailer)
    {

        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;


    }

    public function send(ContactForm $form)
    {


        $sent = $this->mailer->compose()
            ->setTo($this->adminEmail)
            ->setSubject($form->subject)
            ->setTextBody($form->body)
            ->send();

        if (!$sent) {
            throw new \RuntimeException('Sending error.');
        }


    }


}