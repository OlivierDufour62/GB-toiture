<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\ConstructionSite;
use App\Entity\Contact;
use App\Entity\Customer;
use App\Entity\Document;
use App\Entity\Image;
use App\Entity\MaterialDocument;
use App\Entity\Materials;
use App\Entity\Service;
use App\Entity\ServiceDocument;
use App\Form\CategoryType;
use App\Form\ConstructionType;
use App\Form\CustomerType;
use App\Form\ContactType;
use App\Form\QuoteType;
use App\Form\ServiceType;
use App\Service\FileUploader;
use Knp\Snappy\Pdf;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class AdminController extends AbstractController
{

    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function adminLogin(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('admin_index');
        }
        // get the login error if there is one
        // $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        // $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('admin/login.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

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
            $this->$entityManager->persist($editCustomer);
            $this->$entityManager->flush();
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
        return $this->render('admin/picture.html.twig', [
            'picture' => $image,
        ]);
    }

    /**
     * @Route("/admin/addconstruction", name="admin_add_image")
     */
    public function addConstruction(Request $request, FileUploader $fileUploader)
    {
        $construction = new ConstructionSite();
        $form = $this->createForm(ConstructionType::class, $construction);
        $form['customer']->remove('firstname');
        $form['customer']->remove('email');
        $form['customer']->remove('password');
        $form['customer']->remove('addressTwo');
        $form['customer']->remove('zipcode2');
        $form['customer']->remove('city2');
        $form['customer']->remove('genre');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /** @var UploadedFile $image */
            $imagelist = $form->get('images')->getData();
            $phonenumber = $request->request->get('phonenumber');
            foreach ($imagelist as $image) {
                $mimeType = $image->getMimeType();
                if ($mimeType !== 'image/jpeg' && $mimeType !==  'image/png' && $mimeType !== 'image/tiff' && $mimeType !==  'image/webp' && $mimeType !== 'image/jpg') {
                    return new JsonResponse('Type mime invalide', 400);
                }
                $imageFileName = $fileUploader->upload($image);
                $img = new Image();
                $img->setName($imageFileName);
                $construction->addImage($img);
                $img->setConstructionSite($construction);
                $customer = $entityManager->getRepository(Customer::class)
                    ->findBy(['phonenumber' => $phonenumber])[0] ?? null;
                if ($customer !== null) {
                    $tmpClient = $construction->getCustomer();
                    $customer->setLastName($tmpClient->getLastname());
                    $customer->setFirstName($tmpClient->getFirstname());
                    $customer->setPhoneNumber($tmpClient->getPhoneNumber());
                    $customer->setGenre($tmpClient->getGenre());
                    $construction->setCustomer($customer);
                }
                $entityManager->persist($construction);
                $entityManager->flush();
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
        // cette méthode me sert a recherche par numéro de téléphone si le client existe et récupéré les données de ce client la fonction isXMLHttpRequest vérifie si la requete est de l'ajax 
        if ($request->isXmlHttpRequest() || $request->query->get('phonenumber') !== '') {
            // je stocke le numéro de téléphone entrée dans une variable a fin d'effectuer le findBy
            $phonenumber = $request->query->get('phonenumber');
            // j'appelle ici l'entityManager c'est lui gére les entité en utilisant le bundle doctrine
            $entityManager = $this->getDoctrine()->getManager();
            // ici la recherche
            $customer = $entityManager->getRepository(Customer::class)
                ->findBy(['phonenumber' => $phonenumber])[0] ?? null;
            if (!$customer) {
                $customer = new Customer();
                $customer->setEmail($phonenumber)
                    ->setFirstname('')
                    ->setLastname('')
                    ->setPhoneNumber('')
                    ->setGenre('');
            }
            // les données que je souhaites récupérer
            $client = ['id' => $customer->getId(), 'lastname' => $customer->getLastname(), 'firstname' => $customer->getfirstname(), 'addresOne' => $customer->getAddresOne(), 'zipcode' => $customer->getZipcode(), 'city' => $customer->getCity(), 'email' => $customer->getEmail(), 'genre' => $customer->getGenre()];
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
     * @Route("/admin/picture", name="admin_picture")
     */
    public function picture()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $picture = $entityManager->getRepository(Image::class)
            ->findAll();
        return $this->render('admin/picture.html.twig', [
            'picture' => $picture,
        ]);
    }

    /**
     * @Route("/admin/pictureisgalery/{id}", name="pictureisgalery")
     */
    public function pictureIsGalery($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pictureGalery = $entityManager->getRepository(Image::class)
            ->find($id);
        if (!$pictureGalery) {
            return new JsonResponse(false);
        }
        $pictureGalery->setIsGalery(!$pictureGalery->getIsGalery());
        $entityManager->persist($pictureGalery);
        $entityManager->flush();
        return new JsonResponse(true);
    }

    /**
     * @Route("/admin/pictureiscarroussel/{id}", name="pictureiscarroussel")
     */
    public function pictureIsCarroussel($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pictureCarroussel = $entityManager->getRepository(Image::class)
            ->find($id);
        if (!$pictureCarroussel) {
            return new JsonResponse(false);
        }
        $pictureCarroussel->setIsCarroussel(!$pictureCarroussel->getIsCarroussel());
        $entityManager->persist($pictureCarroussel);
        $entityManager->flush();
        return new JsonResponse(true);
    }

    /**
     * @Route("/admin/pictureisactive/{id}", name="pictureisactive")
     */
    public function pictureIsActive($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $pictureIsActive = $entityManager->getRepository(Image::class)
            ->find($id);
        if (!$pictureIsActive) {
            return new JsonResponse(false);
        }
        $pictureIsActive->setIsActive(!$pictureIsActive->getIsActive());
        $entityManager->persist($pictureIsActive);
        $entityManager->flush();
        return new JsonResponse(true);
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

    /**
     * @Route("/admin/replymessage/{id}", name="admin_reply_message")
     */
    public function replyMessage(Request $request, $id, MailerInterface $mailer)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $message = $entityManager->getRepository(Contact::class)
            ->find($id);
        $discussion = $entityManager->getRepository(Contact::class)
            ->findBy(['id' => $id]);
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
            $email = (new Email())
                ->from('projetwebafpa@gmail.com')
                ->to($message->getEmail())
                ->subject($form->get('object')->getData())
                ->text($form->get('message')->getData());
            $mailer->send($email);
            return new JsonResponse(true);
        }
        return $this->render('admin/replymessage.html.twig', [
            'form' => $form->createView(), 'contact' => $message, 'discussion' => $discussion,
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

    /**
     * @Route("/admin/quoterequest", name="admin_quoterequest")
     */
    public function quoteRequest()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $quoteRequest = $entityManager->getRepository(Document::class)
            ->findBy(['type' => 'Pré-devis']);
        return $this->render('admin/quoterequest.html.twig', [
            'quoterequest' => $quoteRequest,
        ]);
    }

    /**
     * @Route("/admin/treatment/{id}", name="admin_treatment_qr")
     */
    public function treatmentQr(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        // ici je recherche l'entité pour procédé aux traitement je le recherche par l'id
        $treatment = $entityManager->getRepository(Document::class)
            ->find($id);
        // on instancie l'entité document
        $pTreatment = new Document();
        $pTreatment->setClient($treatment->getClient());
        $imageTreatment = $treatment->getImages();
         // crée me formulaire QuoteType qui correspond à celui que j'ai choisis pour créer les documents (facture ou devis), le 'allow_extra_fields' définie a true indique qu'un champ sera rempli d'une autre façon que celle de symfony pour ma part j'ai choisis d'envoyé un tableau a json a une méthode ajax
        $formTreatmentQr = $this->createForm(QuoteType::class, $treatment, ['allow_extra_fields' => true]);
        // supprime des champs
        $formTreatmentQr['client']->remove('addressTwo');
        $formTreatmentQr['client']->remove('zipcode2');
        $formTreatmentQr['client']->remove('city2');
        $formTreatmentQr['client']->remove('password');
        $formTreatmentQr->handleRequest($request);
        $pTreatment->setType('Devis');
        $pTreatment->setAdditionnalInformation('');
        // dd($formTreatmentQr);
        // ici la condition qui vérifie que le formulaire est soumis et valide
        if ($formTreatmentQr->isSubmitted() && $formTreatmentQr->isValid()) {
            // dd($request);
            $pTreatment->setName($formTreatmentQr['client']->get('lastname')->getData());
            $pTreatment->setTypeBat('Maison');
            $materialDocument = new MaterialDocument();
            // j'effectue ici un foreach sur chaque groupe de champ lié a serviceDocument car j'ai utilisé le "clonage" de champs avec les prototype
            foreach ($formTreatmentQr['serviceDocuments'] as $value) {
                // ici j'effectue une instanciation de la classe sericeDocument
                $serviceDocument = new ServiceDocument();
                // dd($value->get('designation')->getData());
                $serviceDocument
                    ->setPrice($value->get('price')->getData())
                    ->setQuantity($value->get('quantity')->getData())
                    ->setUnity($value->get('unity')->getData())
                    ->setDocument($pTreatment);
                $service = $entityManager->getRepository(Service::class)
                    ->find($value->get('designation')->getData());
                $serviceDocument->setService($service);
                $entityManager->persist($serviceDocument);
            }
            $pTreatment->addServiceDocument($serviceDocument);
            $pTreatment->addMaterialDocument($materialDocument);
            foreach ($formTreatmentQr['materialDocuments'] as $value) {
                // ici j'effectue une instanciation de la classe materialDocument
                $materials = new Materials();
                $materials->setLibelle($value->get('libelle')->getData())
                    ->setPrice($value->get('price')->getData())
                    ->setQuantity($value->get('quantity')->getData())
                    ->setUnity($value->get('unity')->getData())
                    ->addMaterialDocument($materialDocument);
                $materialDocument->setMaterial($materials);
                $materialDocument->setDocument($pTreatment);
                $entityManager->persist($materials);
            }
            $entityManager->persist($pTreatment);
            $entityManager->flush();
            return new JsonResponse(true);
        }
        return $this->render('admin/treatment.html.twig', [
            'treatment' => $treatment, 'formtreatmentqr' => $formTreatmentQr->createView(), 'imagetreatment' => $imageTreatment
        ]);
    }

    /**
     * @Route("/admin/service/{idcat}", name="admin_service")
     */
    public function serviceAjax($idcat)
    {
        // cette méthode sert a récuéperer les services lié a une catégorie tout en les envoyant en json 
        $entityManager = $this->getDoctrine()->getManager();
        $service = $entityManager->getRepository(Service::class)
            ->findBy(['category' => $idcat]);
        // j'ai utilisé ce principe afin de les récupérer en ajax ici j'ai définis l'objet a laquelle les données que j'ai besoin sont stocké, ensuite le status qui seront envoyé sous forme de tableau et ensuite le groupe de données que j'ai choisis dans mon entité en utilisant les groups avec les annotations 
        return $this->json($service, 200, [], ['groups' => 'service']);
    }

    /**
     * @Route("/admin/document", name="admin_document")
     */
    public function document()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $document = $entityManager->getRepository(Document::class)
            ->findAll();
        return $this->render('admin/document.html.twig', [
            'document' => $document,
        ]);
    }

    /**
     * @Route("/admin/generatepdf/{id}", name="admin_generate_pdf")
     * @return Response
     */
    public function generatePdf($id, MailerInterface $mailer)
    {
        // on appelle snappy pdf
        $snappy = new Pdf();
        // ici on appelle la variable d'environnement WKHTMLPDF
        $snappy->setBinary($_ENV['WKHTMLTOPDF_PATH']);
        // ici on appelle le css 
        $snappy->setOption('user-style-sheet', 'C:/wamp64/www/GB-toiture/public/assets/css/pdf.css');
        $entityManager = $this->getDoctrine()->getManager();
        $devis = $entityManager->getRepository(Document::class)
            ->find($id);
        // ici on effectue une recherche dans les deux tables avec comme clé "document" qui correspond à l'id du devis (foreign key) en question afin de les envoyé a la vue et ajouter les lignes au devis
        $serviceDoc[] = $entityManager->getRepository(ServiceDocument::class)
            ->findBy(['document' => $devis]);
        $materialDoc[] = $entityManager->getRepository(MaterialDocument::class)
            ->findBy(['document' => $devis]);
        // dd($serviceDoc);
        // calcul du prix du total des services afin de pouvoir le récupéré et faire le total du document
        $servicePrice = [];
        foreach ($serviceDoc as $servicedoc) {
            $tmptotal = 0;
            foreach ($servicedoc as $service) {
                $tmptotal += $service->getPrice() * $service->getQuantity();
            }
            $servicePrice[] = $tmptotal;
        }
        // calcul du prix du total des matériaux afin de pouvoir le récupéré et faire le total du document
        $materialPrice = [];
        foreach ($materialDoc as $materialdoc) {
            $tmptotalM = 0;
            foreach ($materialdoc as $material) {
                $tmptotalM += $material->getMaterial()->getPrice() * $material->getMaterial()->getQuantity();
            }
            $materialPrice[] = $tmptotalM;
        }
        // ici je crée la variable du total qui vient additionner le total des services + le total des matériaux afin d'envoyer celui ci a la vue
        $totalDocument = $tmptotal + $tmptotalM;
        // ici on envoie une vue twig afin de permettre la génération du pdf 
        $html = $this->twig->render('pdf/pdf.html.twig', ['devis' => $devis, 'service' => $serviceDoc, 'material' => $materialDoc, 'totaldocument' => $totalDocument]);
        // dd($snappy->getOutputFromHtml($html));
        $pdf = $snappy->getOutputFromHtml($html);
        $email = (new TemplatedEmail())
            ->from('projetwebafpa@gmail.com')
            ->to($devis->getClient()->getEmail())
            ->attach($pdf, sprintf($devis->getId() . '.pdf'));
        $mailer->send($email);
        file_put_contents('C:/wamp64/www/GB-Toiture/public/generate/' . sprintf($devis->getId() . '.pdf'), $pdf);
        return new Response();
    }

    /**
     * @Route("/admin/createdocument", name="admin_create_document")
     */
    public function createDocument(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        // on instancie l'entité document
        $createPdf = new Document();
        // crée me formulaire QuoteType qui correspond à celui que j'ai choisis pour créer les documents (facture ou devis), le 'allow_extra_fields' définie a true indique qu'on champ sera remplie d'une autre façon que celle de symfony pour ma part j'ai choisis d'envoyé un tableau a json a une méthode ajax
        $formcreatePdf = $this->createForm(QuoteType::class, $createPdf, ['allow_extra_fields' => true]);
        // supprime des champs
        $formcreatePdf['client']->remove('addressTwo');
        $formcreatePdf['client']->remove('zipcode2');
        $formcreatePdf['client']->remove('city2');
        $formcreatePdf['client']->remove('password');
        $formcreatePdf->remove('additionnalInformation');
        $formcreatePdf->handleRequest($request);
        // récupére les données du champs phonenumber avec lequel j'effectue une recherche par numéro de téléphone afin de vérifier si le client existe ainsi si il existe les champs seront remplis automatiquement 
        $phonenumber = $request->request->get('phonenumber');
        // a revoir
        $createPdf->setType('Devis');
        $createPdf->setAdditionnalInformation('');
        // dd($formcreatePdf);
        // ici la condition qui vérifie que le formulaire est soumis et valide
        if ($formcreatePdf->isSubmitted() && $formcreatePdf->isValid()) {
            // a revoir
            $createPdf->setTypeBat('Maison');
            // j'effectue ici un foreach sur chaque groupe de champ lié a serviceDocument car j'ai utilisé le "clonage" de champs avec les prototype
            foreach ($formcreatePdf['serviceDocuments'] as $value) {
                // ici j'effectue une instanciation de la classe sericeDocument
                $serviceDocument = new ServiceDocument();
                $serviceDocument
                    ->setPrice($value->get('price')->getData())
                    ->setQuantity($value->get('quantity')->getData())
                    ->setUnity($value->get('unity')->getData())
                    ->setDocument($createPdf);
                $service = $entityManager->getRepository(Service::class)
                    ->find($value->get('designation')->getData());
                $serviceDocument->setService($service);
                $entityManager->persist($serviceDocument);
            }
            // ici j'effectue une instanciation de la classe materialDocument
            $materialDocument = new MaterialDocument();
            // j'ajoute les a serviceDocument et materialDocument les données recu par le formulaire
            $createPdf->addServiceDocument($serviceDocument);
            $createPdf->addMaterialDocument($materialDocument);
            // j'effectue ici un foreach sur chaque groupe de champ lié a materialDocument car j'ai utilisé le "clonage" de champs avec les prototype
            foreach ($formcreatePdf['materialDocuments'] as $value) {
                $materials = new Materials();
                $materials->setLibelle($value->get('libelle')->getData())
                    ->setPrice($value->get('price')->getData())
                    ->setQuantity($value->get('quantity')->getData())
                    ->setUnity($value->get('unity')->getData())
                    ->addMaterialDocument($materialDocument);
                $materialDocument->setMaterial($materials);
                $materialDocument->setDocument($createPdf);
                $entityManager->persist($materials);
            }
            // c'est ici que la recherche par numéro de téléphone fait son effet le numéro de téléphone est donc rechercher dans la base de données si il est différent de null le document lui sera alors attribué dans le cas contraire le client sera ajouté 
            $client = $entityManager->getRepository(Customer::class)
                ->findBy(['phonenumber' => $phonenumber])[0] ?? null;
            //verifier code car enregistre plusieurs fois le meme client 
            if ($client !== null) {
                // $createPdf->setClient($client);
                $tmpClient = $createPdf->getClient();
                $client->setLastName($tmpClient->getLastname());
                $client->setFirstName($tmpClient->getFirstname());
                $client->setPhoneNumber($tmpClient->getPhoneNumber());
                $client->setGenre($tmpClient->getGenre());
                $createPdf->setClient($client);
            }
            $entityManager->persist($createPdf);
            $entityManager->flush();
            return new JsonResponse(['id' => $createPdf->getId()]);
        }
        return $this->render('admin/createdocument.html.twig', [
            'treatment' => $createPdf, 'formcreatePdf' => $formcreatePdf->createView(),
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
}
