<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\ConstructionSite;
use App\Entity\Contact;
use App\Entity\Customer;
use App\Entity\Image;
use App\Entity\Service;
use App\Form\CategoryType;
use App\Form\ConstructionType;
use App\Form\CustomerType;
use App\Form\ContactType;
use App\Form\ServiceType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class AdminController extends AbstractController
{

    // public function __construct()
    // {
    //     $entityManager = $this->getDoctrine()->getManager();
    // }
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
            'allCustomer' => $customer,
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
            $entityManager->persist($editCustomer);
            $entityManager->flush();
            return new JsonResponse(true);
        }
        return $this->render('admin/editcustomer.html.twig', [
            'customer' => $editCustomer, 'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/customerisactive/{id}", name="customerisactive")
     */
    public function customerIsActive($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $customer = $entityManager->getRepository(Customer::class)
            ->find($id);
        if (!$customer) {
            return new JsonResponse(false);
        }
        $customer->setIsActive(!$customer->getIsActive());
        $entityManager->persist($customer);
        $entityManager->flush();
        return new JsonResponse(true);
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
     * @Route("/admin/addconstruction", name="admin_add_image")
     */
    public function addConstruction(Request $request, FileUploader $fileUploader)
    {
        // $images = new Image();
        $construction = new ConstructionSite();
        $form = $this->createForm(ConstructionType::class, $construction);
        $form['customer']->remove('password');
        $form['customer']->remove('firstname');
        $form['customer']->remove('phonenumber');
        $form['customer']->remove('addressTwo');
        $form['customer']->remove('zipcode2');
        $form['customer']->remove('city2');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var UploadedFile $image */
            $imagelist = $form->get('images')->getData();
            $email = $request->request->get('email');
            foreach ($imagelist as $image) {
                if ($image) {
                    $mimeType = $image->getMimeType();
                    if ($mimeType !== 'image/jpeg' && $mimeType !==  'image/png' && $mimeType !== 'image/tiff' && $mimeType !==  'image/webp' && $mimeType !== 'image/jpeg') {
                        return new JsonResponse($mimeType !== 'image/jpeg');
                    }
                    $imageFileName = $fileUploader->upload($image);
                    $img = new Image();
                    $img->setName($imageFileName);
                    $construction->addImage($img);
                    $img->setConstructionSite($construction);
                    $customer = $entityManager->getRepository(Customer::class)
                        ->findBy(['email' => $email])[0] ?? null;
                    if ($customer !== null) {
                        $construction->setCustomer($customer);
                    }
                    $entityManager->persist($construction);
                    $entityManager->flush();
                }
            }
            return new JsonResponse(true);
        }
        return $this->render('admin/add_image.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/searchcustomer", name="admin_search_customer")
     */
    public function searchCustomer(Request $request)
    {
        if ($request->isXmlHttpRequest() || $request->query->get('email') !== '') {
            $email = $request->query->get('email');
            $entityManager = $this->getDoctrine()->getManager();
            $customer = $entityManager->getRepository(Customer::class)
                ->findBy(['email' => $email])[0] ?? null;
            $client = ['id' => $customer->getId(), 'lastname' => $customer->getLastname(), 'addresOne' => $customer->getAddresOne(), 'zipcode' => $customer->getZipcode(), 'city' => $customer->getCity(), 'email' => $customer->getEmail()];
            return new JsonResponse($client);
        } else {
            return new JsonResponse(false);
        }
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
            $entityManager->persist($cat);
            $entityManager->flush();
            return new JsonResponse(true);
        }
        $category = $entityManager->getRepository(Category::class)
            ->findAll();
        return $this->render('admin/prestation.html.twig', [
            'allService' => $service, 'category' => $category, 'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/addservice", name="admin_add_service")
     */
    public function addService(Request $request)
    {
        $addService = new Service();
        $form = $this->createForm(ServiceType::class, $addService);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($addService);
            $entityManager->flush();
            return new JsonResponse(true);
        }
        return $this->render('admin/add_service.html.twig', [
            'service' => $addService,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/editservice/{id}", name="admin_edit_service")
     */
    public function editService(Request $request, $id)

    {
        $entityManager = $this->getDoctrine()->getManager();
        $editService = $entityManager->getRepository(Service::class)
            ->find($id);
        $form = $this->createForm(ServiceType::class, $editService);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($editService);
            $entityManager->flush();
            return new JsonResponse(true);
        }
        return $this->render('admin/editservice.html.twig', [
            'service' => $editService, 'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/serviceisactive/{id}", name="serviceisactive")
     */
    public function serviceIsActive($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $service = $entityManager->getRepository(Service::class)
            ->find($id);
        if (!$service) {
            return new JsonResponse(false);
        }
        $service->setIsActive(!$service->getIsActive());
        $entityManager->persist($service);
        $entityManager->flush();
        return new JsonResponse(true);
    }

    /**
     * @Route("/admin/categoryisactive/{id}", name="categoryisactive")
     */
    public function categoriesIsActive($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $category = $entityManager->getRepository(Category::class)
            ->find($id);
        if (!$category) {
            return new JsonResponse(false);
        }
        $category->setIsActive(!$category->getIsActive());
        $entityManager->persist($category);
        $entityManager->flush();
        return new JsonResponse(true);
    }

    /**
     * @Route("/admin/editcategory/{id}", name="admin_edit_category")
     */
    public function editCategory(Request $request, $id)

    {
        $entityManager = $this->getDoctrine()->getManager();
        $editCategory = $entityManager->getRepository(Category::class)
            ->find($id);
        $form = $this->createForm(CategoryType::class, $editCategory);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($editCategory);
            $entityManager->flush();
            return new JsonResponse(true);
        }
        return $this->render('admin/editcategory.html.twig', [
            'category' => $editCategory, 'formEdit' => $form->createView(),
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
        $entityManager = $this->getDoctrine()->getManager();
        $contact = $entityManager->getRepository(Contact::class)
            ->findAll();
        return $this->render('admin/message.html.twig', [
            'contact' => $contact,
        ]);
    }

    // /**
    //  * @Route("/admin/response/{id}", name="admin_reply_message")
    //  */
    // public function response(Request $request, $id)
    // {
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $contact = $entityManager->getRepository(Contact::class)
    //         ->find($id);
    //     $template = $request->isXmlHttpRequest() ? 'template_xhr.html.twig' : 'replymessage.html.twig';
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $contactResponse = new Contact();
    //     $form = $this->createForm(ContactType::class, $contactResponse);
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $contactResponse->setIsResponse(true);
    //         $entityManager->persist($contactResponse);
    //         $entityManager->flush();
    //     }
    //     return $this->render($template, [
    //         'form' => $form->createView(), 'contact' => $contact
    //     ]);
    // }

    /**
     * @Route("/admin/replymessage/{id}", name="admin_reply_message")
     */
    public function replyMessage(Request $request, $id, $conversation, MailerInterface $mailer)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $message = $entityManager->getRepository(Contact::class)
            ->find($id);
        $discussion = $entityManager->getRepository(Contact::class)
            ->findBy(['id'=>$id, 'conversation'=> $conversation]);
        $contactResponse = new Contact();
        $form = $this->createForm(ContactType::class, $contactResponse);
        $form->remove('lastname');
        $form->remove('firstname');
        $form->remove('address');
        $form->remove('zipcode');
        $form->remove('city');
        $form->remove('addressTwo');
        $form->remove('zipcodeTwo');
        $form->remove('cityTwo');
        $form->remove('phonenumber');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactResponse->setIsResponse(true);
            $contactResponse->setlastname('');
            $contactResponse->setFirstname('');
            $contactResponse->setAddress('');
            $contactResponse->setZipcode('');
            $contactResponse->setCity('');
            $contactResponse->setPhonenumber('');
            $contactResponse->setConversation($message);
            $entityManager->persist($contactResponse);
            $entityManager->flush();
            $email = (new Email())
                ->from('projetwebafpa@gmail.com')
                ->to($message->getEmail())
                ->subject($form->get('object')->getData())
                ->text($form->get('message')->getData());
            $mailer->send($email);
            return new JsonResponse(true);
        }
        return $this->render('admin/replymessage.html.twig', [
            'form' => $form->createView(), 'contact' => $message, 'discussion'=>$discussion,
        ]);
    }

    /**
     * @Route("/admin/messageisactive/{id}", name="messageisactive")
     */
    public function messageIsActive($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $message = $entityManager->getRepository(Contact::class)
            ->find($id);
        if (!$message) {
            return new JsonResponse(false);
        }
        $message->setIsActive(!$message->getIsActive());
        $entityManager->persist($message);
        $entityManager->flush();
        return new JsonResponse(true);
    }
}
