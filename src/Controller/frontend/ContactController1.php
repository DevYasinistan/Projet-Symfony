<?php

// declare(strict_types=1);

// namespace App\Controller\frontend;

// use App\Entity\Contact;
// use App\Form\ContactType;
// use Symfony\Bridge\Twig\Mime\TemplatedEmail;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Mailer\MailerInterface;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// class ContactController extends AbstractController
// {


//     /**
//      * @Route("/contact", name="app_contact_contact")
//      */
//     public function contact(Request $request, MailerInterface $mailer): Response
//     {
//         $form = $this->createForm(ContactType::class);
//         $contact = $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {

//             $email = (new TemplatedEmail())
//                 ->from($contact->get('email')->getData())
//                 ->to('amcem@amcem-menuiserie.fr')
//                 ->subject('Un visiteur vous a envoyer un message !')
//                 ->htmlTemplate('emails/contact.html.twig')
//                 ->context([
//                     'mail' => $contact->get('email')->getData(),
//                     'message' => $contact->get('message')->getData()
//                 ]);

//             $message = $form->get('message')->getData();
//             $message->get('email')->getData();
//             $manager = $this->getDoctrine()->getManager();

//             $manager->persist($message);

//             $manager->flush();

//             $this->addFlash('message', 'Votre message a bien été envoyé');

//             return $this->redirectToRoute('app_contact_contact');
//         }
//         return $this->render('frontend/contact.html.twig', ['form' => $form->createView(),]);
//     } 

//     /**
//      * @Route("/message/{id}", name="app_contact_message")
//      */
//     public function message(int $id): Response
//     {
//         $repository = $this->getDoctrine()->getRepository(Contact::class);
//         $message = $repository->find($id);

//         return $this->render('frontend/message.html.twig', ['message' => $message,]);
//     }
// }  -->
