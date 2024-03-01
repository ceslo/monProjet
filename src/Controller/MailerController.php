<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class MailerController extends AbstractController
{
    #[Route('/email', name: 'app_mailer')]
    public function sendEmail(MailerInterface $mailer)
    {
        $email= (new TemplatedEmail())
        ->from('hello@example.com')
        ->to('you@example.com')
        ->subject('Time for Symfony Mailer!')
        
        ->htmlTemplate('emails/signup.html.twig')
        -> context([
            'expiration_date'=> new \DateTime('+7 days'),
            'username'=>'foo'
        ]);
        $mailer->send($email);
    }
    public function index(): Response
    {
        return $this->render('mailer/index.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }
}
