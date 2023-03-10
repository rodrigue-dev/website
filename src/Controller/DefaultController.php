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
