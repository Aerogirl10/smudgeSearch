<?php

namespace App\Controller;

use App\Repository\ToolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function searchBar() {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('handleSearch'))
            ->add('toolQuery', TextType::class, [
                'attr' => [
                    'class' => 'toolQuery'
                ]
            ])
            ->add('inkQuery', TextType::class)
            ->add('PaperQuery', TextType::class)
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();

        return $this->render('product/index.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * @param Request $request
     * @Route("/handleSearch", name="handleSearch")
     */
    public function handleSearch(Request $request, ToolRepository $toolRepository){
        $tool = $request->request->get('form')['query'];
        if ($tool) {
            $toolRes = $toolRepository->findToolByModel($tool);
        }
        dump($toolRes);die;
    }
}
