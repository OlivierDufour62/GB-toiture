<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Service;
use App\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/index", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig'
        );
    }

    /**
     * @Route("/admin/customer", name="admin_customer")
     */
    public function customer()
    {
        return $this->render('', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/addcustomer", name="admin_add_customer")
     */
    public function addCustomer()
    {
        return $this->render('', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/editcustomer", name="admin_edit_customer")
     */
    public function editCustomer()
    {
        return $this->render('', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/image", name="admin_image")
     */
    public function image()
    {
        return $this->render('', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/addimage", name="admin_add_image")
     */
    public function addImage()
    {
        return $this->render('', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/prestation", name="admin_prestation")
     */
    public function prestation()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $service = $entityManager->getRepository(Service::class)
                                    ->findAll();
        $category = $entityManager->getRepository(Category::class)
                                    ->findAll();
        return $this->render('admin/prestation.html.twig', [
            'presta' => $service, 'category' => $category,
        ]);
    }

    /**
     * @Route("/admin/addprestation", name="admin_add_prestation")
     */
    public function addPrestation(Request $request)
    {
        $addPresta = new Service();
        $form = $this->createForm(ServiceType::class, $addPresta);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addPresta);
            $entityManager->flush();
            // return new JsonResponse(true);
        }
        return $this->render('admin/add_prestation.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/document", name="admin_document")
     */
    public function document()
    {
        return $this->render('', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/createdocument", name="admin_create_document")
     */
    public function createDocument()
    {
        return $this->render('', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/editdocument", name="admin_edit_document")
     */
    public function editDocument()
    {
        return $this->render('', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/message", name="admin_message")
     */
    public function message()
    {
        return $this->render('', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/replymessage", name="admin_reply_message")
     */
    public function replyMessage()
    {
        return $this->render('', [
            'controller_name' => 'AdminController',
        ]);
    }
}