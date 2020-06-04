<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{

    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/prestation", name="prestation")
     */
    public function prestation()
    {
        return $this->render('public/prestation.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/realisation", name="realisation")
     */
    public function realisation()
    {
        return $this->render('public/realisation.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/galery", name="galery")
     */
    public function galery()
    {
        return $this->render('public/galery.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/devis", name="devis")
     */
    public function devis()
    {
        return $this->render('public/devis.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($contact);
            $entityManager->flush();
        }
        return $this->render('public/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
