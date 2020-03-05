<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Form\Model\ContactFormModel;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact.index")
     */
    public function index(Request $request): Response
    {
        /*
		 * affichage d'un formulaire
		 *   se base
		 *      - sur l'espace de noms de la classe de formulaire
		 *      - sur une instance du modèle relié à la classe de formulaire
		 *  handleRequest permet de récupérer la saisie dans la requête HTTP
		 *  createView permet d'envoyer le formulaire sous forme de vue
		 */
        $type = ContactType::class;
        $model = new ContactFormModel();
        $form = $this->createForm($type, $model);
        $form->handleRequest($request);

        /* if ($form->isSubmitted() && $form->isValid()) {

            $message = (new TemplatedEmail())
                ->from($model->getEmail()) // expéditeur
                ->to(' 4fac0ec5a7-6da8bd@inbox.mailtrap.io') // destinataire
                ->subject('Contact') // sujet de l'email
                ->textTemplate('emailing/contact.txt.twig') // cibler un template twig au format txt
                ->context([
                    'firstname' => $model->getFirstname(),
                    'lastname' => $model->getLastname(),
                    'message' => $model->getMessage(),
                ]);

            $mailer->send($message);
            $this->addFlash('notice', "Votre message a été envoyé");

            return $this->redirectToRoute('homepage.index');
        }
*/
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
