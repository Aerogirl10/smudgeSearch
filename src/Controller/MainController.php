<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Form\BrandSelectTextType;
use App\Repository\BrandRepository;
use App\Repository\ToolRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/search-test", name="test")
     */
    public function searchBar()
    {
        $brandForm = $this->createForm(BrandSelectTextType::class);
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('toolQuery', TextType::class, [
                'attr' => [
                    'class' => 'toolQuery'
                ]
            ])
            ->add('inkQuery', TextType::class)
            ->add('paperQuery', TextType::class)
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();

        return $this->render('product/index.html.twig', [
            'form' => $form->createView(),
            'brandForm' => $brandForm->createView(),

        ]);
    }

    /**
     * @param Request $request
     * @Route("/handleSearch", name="handleSearch")
     */
    public function handleSearch(Request $request, ToolRepository $toolRepository)
    {
//        dump($request->request->get('form'));die;
        $tool = $request->request->get('form')['toolQuery'];
        $ink = $request->request->get('form')['inkQuery'];
        $paper = $request->request->get('form')['paperQuery'];
        //dump($tool);
        if ($tool) {
            $toolRes = $toolRepository->findToolByModel($tool);
        }
        /*if ($ink) {
            $inkRes = $toolRepository->findToolByModel($ink);
        }
        if ($paper) {
            $paperRes = $toolRepository->findToolByModel($paper);
        }*/
//        dump($toolRes);
////        dump($inkRes);
////        dump($paperRes);
//        die;

        return new Response(json_encode($toolRes));

        return $this->render('product/index.html.twig', [
            'toolResults' => $toolRes,

        ]);

//        return $this->render('main/search-result.html.twig', [
//            'toolResults' => $toolRes,
//        ]);
    }

    /**
     * @param Request $request
     * @Route("/handleSearch/{_brand?}", name="search", methods={"POST", "GET"})
     */
    public function handleSearchRequest(Request $request, $_brand, BrandRepository $brandRepository)
    {
        if ($_brand){
            $data = $brandRepository->findByName($_brand);
        } else {
            $data = $brandRepository->findAll();
        }

        $normalizers = [new ObjectNormalizer()];
        $encoders = [new JsonEncoder()];
        $serializer = new Serializer($normalizers, $encoders);

        $data = $serializer->serialize($data, 'json');

        return new JsonResponse($data, 200, [], true);

    }
}
