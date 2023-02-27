<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function contact(Request $request): Response
    {
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
     * @Route("/{_locale<%app.supported_locales%>}/learn", name="learn")
     * @param Request $request
     * @return Response
     */
    public function cours_langue(Request $request): Response
    {
        return $this->render('default/learn.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/ressource-h", name="ressource-h")
     * @param Request $request
     * @return Response
     */
    public function rh(Request $request): Response
    {
        return $this->render('default/ressource-h.html.twig', [
        ]);
    }
    /**
     * @Route("/{_locale<%app.supported_locales%>}/recrutement", name="recrutement")
     * @param Request $request
     * @return Response
     */
    public function recrutement(Request $request): Response
    {
        return $this->render('default/recrutement.html.twig', [
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
