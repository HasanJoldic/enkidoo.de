<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render("default/index.html.twig", [
            "base_dir" => realpath($this->getParameter("kernel.project_dir")).DIRECTORY_SEPARATOR,
            "activePage" => "homepage"
        ]);
    }

    /**
     * @Route("/projekte/", name="projects")
     */
    public function projectsAction(Request $request)
    {
        return $this->render("default/projects.html.twig", [
            "base_dir" => realpath($this->getParameter("kernel.project_dir")).DIRECTORY_SEPARATOR,
            "activePage" => "projects"
        ]);
    }

    /**
     * @Route("/projekte/ishap/", name="projects_ishap")
     */
    public function projectsIshapAction(Request $request)
    {
        return $this->render("default/projects_ishap.html.twig", [
            "base_dir" => realpath($this->getParameter("kernel.project_dir")).DIRECTORY_SEPARATOR,
            "activePage" => "projects"
        ]);
    }

    /**
     * @Route("/projekte/miro-gradnja/", name="projects_miro-gradnja")
     */
    public function projectsMiroGradnjaAction(Request $request)
    {
        return $this->render("default/projects_miro-gradnja.html.twig", [
            "base_dir" => realpath($this->getParameter("kernel.project_dir")).DIRECTORY_SEPARATOR,
            "activePage" => "projects"
        ]);
    }

    /**
     * @Route("/kontakt/", name="contact")
     * @Method({"GET"})
     */
    public function contactAction(Request $request)
    {
        $error = $request->query->get("error");
        $success = $request->query->get("success");

        return $this->render("default/contact.html.twig", [
            "base_dir" => realpath($this->getParameter("kernel.project_dir")).DIRECTORY_SEPARATOR,
            "error" => $error,
            "success" => $success,
            "activePage" => "contact"
        ]);
    }

    /**
     * @Route("/kontakt/", name="contact_post")
     * @Method({"POST"})
     */
    public function contactPostAction(Request $request, \Swift_Mailer $mailer)
    {


        $message = (new \Swift_Message("Upit"))
            ->setFrom("office@enkidoo.de")
            ->setTo("office@enkidoo.de")
            ->setSender($request->request->get("email"))
            ->setReplyTo($request->request->get("email"), $request->request->get("name"))
            ->setBody("Ime: ".$request->request->get("name")."\r\n"
                ."Tel.: ".$request->request->get("tel")."\r\n"
                ."Email: ".$request->request->get("email")."\r\n"."\r\n"."\r\n"."Poruka:"."\r\n"
                .$request->request->get("message"))
        ;

        $error = $mailer->send($message);

        if ($error == 0) {
            $error = "Es kamm zu einen Fehler bei Senden der Email!";
        } else {
            $error = null;
            $success = "Email erfolgreich gesendet!";
        }

        return $this->redirectToRoute("contact", [
            "error" => $error,
            "success" => $success
        ]);
    }

    /**
     * @Route("/impressum/", name="inprint")
     */
    public function inprintAction(Request $request)
    {
        return $this->render("default/inprint.html.twig", [
            "base_dir" => realpath($this->getParameter("kernel.project_dir")).DIRECTORY_SEPARATOR,
        ]);
    }
}
