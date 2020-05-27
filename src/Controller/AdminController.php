<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Customer;
use App\Entity\Image;
use App\Entity\Service;
use App\Form\CategoryType;
use App\Form\CustomerType;
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
        return $this->render(
            'admin/index.html.twig'
        );
    }

    /**
     * @Route("/admin/customer", name="admin_customer")
     */
    public function customer()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $customer = $entityManager->getRepository(Customer::class)
            ->findAll();
        return $this->render('admin/customer.html.twig', [
            'customer' => $customer,
        ]);
    }

    /**
     * @Route("/admin/addcustomer", name="admin_add_customer")
     */
    public function addCustomer(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $addCustomer = new Customer();
        $form = $this->createForm(CustomerType::class, $addCustomer);
        $form->remove('password');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addCustomer);
            $entityManager->flush();
            return new JsonResponse(true);                          
        }
        return $this->render('admin/addcustomer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/editcustomer/{id}", name="admin_edit_customer")
     */
    public function editCustomer(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $editCustomer = $entityManager->getRepository(Customer::class)
            ->find($id);
        $form = $this->createForm(CustomerType::class, $editCustomer);
        $form->remove('password');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($editCustomer);
            $entityManager->flush();
            return new JsonResponse(true);
        }
        return $this->render('admin/editcustomer.html.twig', [
            'customer' => $editCustomer, 'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/image", name="admin_image")
     */
    public function image()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $image = $entityManager->getRepository(Image::class)
            ->findAll();
        return $this->render('admin/image.html.twig', [
            'image' => $image,
        ]);
    }

    /**
     * @Route("/admin/addimage", name="admin_add_image")
     */
    public function addImage()
    {
        
        return $this->render('admin/addimage.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/prestation", name="admin_prestation")
     */
    public function prestation(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $service = $entityManager->getRepository(Service::class)
            ->findAll();
        $cat = new Category();
        $form = $this->createForm(CategoryType::class, $cat);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cat);
            $entityManager->flush();
            return new JsonResponse(true);
        }
        $category = $entityManager->getRepository(Category::class)
        ->findAll();
        return $this->render('admin/prestation.html.twig', [
            'service' => $service, 'category' => $category, 'form' => $form->createView(),
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
     * @Route("/admin/editcategory/{id}", name="admin_edit_category")
     */
    public function editPrestation(Request $request, $id)
    {
        $addPresta = new Service();
        $entityManager = $this->getDoctrine()->getManager();
        $category = $entityManager->getRepository(Category::class)
            ->findBy(['id' => $id]);
        $form = $this->createForm(CategoryType::class, $addPresta);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addPresta);
            $entityManager->flush();
            // return new JsonResponse(true);
        }
        return $this->render('admin/prestation.html.twig', [
            'form' => $form->createView(), 'category' => $category
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
