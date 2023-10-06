<?php

namespace App\Controller;

use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class DefaultController extends AbstractController
{
    private $logger;

    /**
     * DefaultController constructor.
     * @param $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/{_locale<%app.supported_locales%>}/", name="home")
     * @param Request $request
     * @return Response
     */

    public function index(Request $request): Response
    {
        return $this->render('default/index.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/about", name="about")
     * @param Request $request
     * @return Response
     */
    public function about(Request $request): Response
    {
        return $this->render('default/about.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/contact", name="contact")
     * @param Request $request
     * @return Response
     */
    public function contact(Request $request, 
    EntityManagerInterface $manager,
    MailerInterface $mailer
    ): Response
    { 
        $contact = new Contact();


        if(isset($_POST["email"])){
        $contact->setFullname($request->get('name'));
        $contact->setVille($request->get('ville'));
        $contact->setTelephone($request->get('telephone'));
        $contact->setEmail($request->get('email'));
        $contact->setEntreprise($request->get('entrepise'));
        $contact->setMessage($request->get('message'));
        $contact->setSubject($request->get('subject'));

        //dd($contact);

        $manager->persist($contact);
        $manager->flush();

        //Email 
        $email = (new TemplatedEmail())
        ->from($contact->getEmail())
        ->to('info@okoho.de')
        ->subject($contact->getSubject())
        ->text($contact->getEntreprise())
        //->text($contact->getVille())
        ->context([
            'contact' => $contact,
        ]);

    $mailer->send($email);

        $this->addFlash('success', 'Votre message a été envoyé avec succès.');
        //return $this->redirectToRoute('dashboard');
        }
             return $this->render('default/contact_us.html.twig', [
        ]);
       
       
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/immigration", name="immigration")
     * @param Request $request
     * @return Response
     */
    public function immigration(Request $request): Response
    {
        return $this->render('default/immigration.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/conseil_employeur", name="conseil_employeur")
     * @param Request $request
     * @return Response
     */
    public function conseil_employeur(Request $request): Response
    {
        return $this->render('default/conseil_employeur.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/conseil_professionel", name="conseil_professionel")
     * @param Request $request
     * @return Response
     */
    public function conseil_professionel(Request $request): Response
    {
        return $this->render('default/conseil_professionel.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/placement_personnel", name="placement_personnel")
     * @param Request $request
     * @return Response
     */
    public function placement_personnel(Request $request): Response
    {
        return $this->render('default/placement_personnel.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/conseil_immigration", name="conseil_immigration")
     * @param Request $request
     * @return Response
     */
    public function conseil_immigration(Request $request): Response
    {
        return $this->render('default/conseil_immigration.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/promotion_integration", name="promotion_integration")
     * @param Request $request
     * @return Response
     */
    public function promotion_integration(Request $request): Response
    {
        return $this->render('default/promotion_integration.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/developpement_personnel", name="developpement_personnel")
     * @param Request $request
     * @return Response
     */
    public function developpement_personnel(Request $request): Response
    {
        return $this->render('default/developpement_personnel.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/faq", name="faq")
     * @param Request $request
     * @return Response
     */
    public function faq(Request $request): Response
    {
        return $this->render('default/faq.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/term_condition", name="term_condition")
     * @param Request $request
     * @return Response
     */
    public function term_condition(Request $request): Response
    {
        return $this->render('default/term_condition.html.twig', [
        ]);
    }
    /**
     * @Route("/change_locale/{locale}", name="change_locale")
     */
    public function changeLocale($locale, Request $request)
    {
        //$request->setLocale($locale);
        $request->getSession()->set('_locale', $locale);
        return $this->redirect($request->headers->get('referer'));
    }
    public function makeappointement(): Response
    {
        return $this->render('includes/makeappointement.html.twig', [
            //'testimonial'=>$bestsellers
        ]);
    }
}
