<?php

namespace App\Controller;

use App\Entity\Jobs;
use App\Entity\Contact;
use App\Form\JobType;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mime\Email;
use App\Repository\JobsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


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
     * @Route("/{_locale<%app.supported_locales%>}/job", name="job")
     * @param Request $request
     * @return Response
     */
    public function job(Request $request): Response
    {
        return $this->render('default/job.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/news", name="news")
     * @param Request $request
     * @return Response
     */
    public function news(Request $request): Response
    {
        return $this->render('default/news.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/service", name="service")
     * @param Request $request
     * @return Response
     */
    public function service(Request $request): Response
    {
        return $this->render('default/service.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/event", name="event")
     * @param Request $request
     * @return Response
     */
    public function event(Request $request): Response
    {
        return $this->render('default/event.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/Impressum", name="Impressum")
     * @param Request $request
     * @return Response
     */
    public function Impressum(Request $request): Response
    {
        return $this->render('default/Impressum.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/datenschutzerklaerung", name="datenschutzerklaerung")
     * @param Request $request
     * @return Response
     */
    public function datenschutzerklaerung(Request $request): Response
    {
        return $this->render('default/datenschutzerklaerung.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/newsandevent", name="newsandevent")
     * @param Request $request
     * @return Response
     */
    public function newsandevent(Request $request, JobsRepository $jobsRepository): Response
    {
        $locale = $request->getLocale(); // par exemple 'fr' ou 'en'
        // vous pouvez ensuite poser des conditions en fonction de la locale
        if ($locale === 'fr') {
            $mois = [1=>"Janvier",2=>"Fevrier",3=>"Mars",4=>"Avril",5=>"Mai",6=>"Juin",7=>"Juillet",8=>"Aout",9=>"Septembre",10=>"Octobre",11=>"Novembre",12=>"Decembre"]; 
        } elseif ($locale === 'en') {
            $mois = [1=>"January",2=>"January",3=>"March",4=>"April",5=>"May",6=>"June",7=>"July",8=>"August",9=>"September",10=>"October",11=>"November",12=>"December"];   
        }elseif ($locale === 'de') {
            $mois = [1=>"Januar",2=>"Februar",3=>"März",4=>"April",5=>"Mai",6=>"Juni",7=>"Juli",8=>"August",9=>"Septembre",10=>"Oktober",11=>"November",12=>"Dezember"]; 
        }

        
        $jobs = $jobsRepository->findByTypeOfJobs('Jobs');
        $news = $jobsRepository->findByTypeOfJobs('News');
        $event = $jobsRepository->findByTypeOfJobs('Events');

        return $this->render('default/newsandevent.html.twig', [ 
            'jobs' => $jobs,
            'events' => $event,
            'news' => $news,
            'mois' => $mois
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
     * @Route("/{_locale<%app.supported_locales%>}/add", name="event&jobs")
     * @param Request $request
     * @return Response
     */
    public function event_jobs(Request $request, EntityManagerInterface $manager, JobsRepository $jobsRepository): Response
    {

        $jobs = new Jobs();

        $form = $this->createForm(JobType::class, $jobs);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $jobsRepository->add($jobs, true);

            return $this->redirectToRoute('newsandevent', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('default/events_jobs.html.twig', [
            'form' => $form
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
