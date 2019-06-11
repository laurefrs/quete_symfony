<?php
/**
 * Created by PhpStorm.
 * User: laure
 * Date: 2019-06-11
 * Time: 14:25
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;



/**
 * @Route("/category")
 * @return Response A response instance
 */
class CategoryController extends AbstractController
{
    /**
     * @Route ("/", name = "add_category")
     * @return Response A response instance
     */

    public function add(Request $request)
        {
            $category = new Category();
            $formCategory = $this->createForm(CategoryType::class, $category);
            $formCategory->handleRequest($request);

            if ($formCategory->isSubmitted() && $formCategory->isValid()){
                $data = $formCategory->getData();
                $em = $this->getDoctrine()->getManager();
                $em->persist($data);
                $em->flush();
                return $this->redirectToRoute('index');
            }
            return $this->render(
                'Blog/add.html.twig' , [
                    'formCategory' => $formCategory->createView()
                ]
            );
        }

}