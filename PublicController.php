<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Customer;
use App\Entity\Document;
use App\Entity\Image;
use App\Entity\Service;
use App\Entity\ServiceDocument;
use App\Form\ContactType;
use App\Form\DocumentType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $imageCaroussel = $entityManager->getRepository(Image::class)
            ->findBy(['isCarroussel' => true]);
            
        return $this->render('public/index.html.twig', [
            'imageCaroussel' => $imageCaroussel,
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
    public function devis(Request $request, FileUploader $fileUploader)
    {
        $quoteRequest = new Document();
        $formQuoteRequest = $this->createForm(DocumentType::class, $quoteRequest);
        $formQuoteRequest['client']->remove('password');
        $formQuoteRequest['client']->remove('addressTwo');
        $formQuoteRequest['client']->remove('zipcode2');
        $formQuoteRequest['client']->remove('city2');
        $formQuoteRequest->remove('name');
        $formQuoteRequest->handleRequest($request);
        $serviceDocument = new ServiceDocument();
        $quoteRequest->addServiceDocument($serviceDocument);
        $serviceDocument->setDocument($quoteRequest);
        $service = new Service();
        $service->addServiceDocument($serviceDocument);
        $serviceDocument->setService($formQuoteRequest->get('service')->getData());
        $quoteRequest->setType('Pré-devis');
        $quoteRequest->setCategory($formQuoteRequest->get('category')->getData());
        if ($formQuoteRequest->isSubmitted() && $formQuoteRequest->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var UploadedFile $image */
            $imagelist = $formQuoteRequest->get('images')->getData();
            $phonenumber = $formQuoteRequest['client']->get('phonenumber')->getData();
            $quoteRequest->setName($formQuoteRequest['client']->get('lastname')->getData());
            // le foreach sert à pouvoir enregistré plusieurs images avec un seul champ
            foreach ($imagelist as $image) {
                $mimeType = $image->getMimeType();
                if ($mimeType !== 'image/jpeg' && $mimeType !==  'image/png' && $mimeType !== 'image/tiff' && $mimeType !==  'image/webp' && $mimeType !== 'image/jpg') {
                    $this->addFlash('alerte', 'Veuillez choisir des images valides.');
                    // return $this->redirectToRoute('admin_add_image');
                }
                $imageFileName = $fileUploader->upload($image);
                $img = new Image();
                $img->setName($imageFileName);
                $quoteRequest->addImage($img);
                $img->setDocument($quoteRequest);
                //vérifie si le numéro de téléphone entrer est existant si il existe il 'set' la demannde au client en question dans le cas contraire il cré un nouveau client 
                $customer = $entityManager->getRepository(Customer::class)
                    ->findBy(['phonenumber' => $phonenumber])[0] ?? null;
                if ($customer !== null) {
                    $quoteRequest->setClient($customer);
                }
                $entityManager->persist($quoteRequest);
                $entityManager->flush();
            }
            return new JsonResponse(true);
        }
        return $this->render('public/devis.html.twig', [
            'formQr' => $formQuoteRequest->createView(),
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
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();
        }
        return $this->render('public/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
