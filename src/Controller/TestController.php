<?php


namespace App\Controller;


use ContainerSOau8kM\getMailer_TransportFactory_SendgridService;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

//require_once './vendor/autoload.php';

class TestController extends AbstractController
{
    /**
     * @Route("/email", name="app_email")
     */
    public function email(MailerInterface $mailer)
    {

        $email = (new TemplatedEmail())
            ->from('alexandragomez.work@gmail.com')
            ->to(new Address('alexandragomez.work@gmail.com'))
            ->subject('Thanks for signing up!')

            // path of the Twig template to render
            ->htmlTemplate('emails/signup.html.twig');


        $mailer->send($email);

        return $this->redirectToRoute('app_dashboard');
    }


/*public function email()
{

    try {
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', '465'))
            ->setUsername('tocomplete.work@gmail.com')
            ->setPassword('tocomplete')
            ->setEncryption('ssl');
        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);
        // Create a message
        $message = (new \Swift_Message('Wonderful Subject'))
            ->setFrom(['tocomplete.work@gmail.com' => 'Blue Spoon'])
            ->setTo(['tocomplete.work@gmail.com' => 'test'])
            ->setBody('Here is the message itself');
        // Send the message
        $result = $mailer->send($message);

        echo 'Mail envoyé';

    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $this->render('dashboard.html.twig');
}*/




}

/*public function index(\Swift_Mailer $mailer)
 {
     $message = (new \Swift_Message('Hello Email'))
         ->setFrom('tocomplete.work@gmail.com')
         ->setTo('tocomplete.work@gmail.com')
         ->setBody(
             $this->renderView('emails/signup.html.twig'
             ),
             'text/html'
         );

     $mailer->send($message);

     return $this->render('dashboard.html.twig');
 }*/

/*
 public function email(MailerInterface $mailer)
{

    $email = (new TemplatedEmail())
        ->from('tocomplete@laposte.net')
        ->to(new Address('tocomplete@laposte.net'))
        ->subject('Thanks for signing up!')

        // path of the Twig template to render
        ->htmlTemplate('emails/signup.html.twig')

        // pass variables (name => value) to the template
        ->context([
            'expiration_date' => new \DateTime('+7 days'),
            'username' => 'foo',
        ]);

    $mailer->send($email);

    return $this->render('dashboard.html.twig');
}
}*/

/* public function email(MailerInterface $mailer)
    {

        $email = (new Email())
            ->from('tocomplete.work@gmail.com')
            ->to(new Address('tocomplete.work@gmail.com'))
            ->subject('Thanks for signing up!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

            // path of the Twig template to render
            //->htmlTemplate('emails/signup.html.twig')

            // pass variables (name => value) to the template
            /*->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'foo',
            ]);

$mailer->send($email);

return $this->render('dashboard.html.twig');
}*/


