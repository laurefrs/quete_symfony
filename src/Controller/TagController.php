<?php
/**
 * Created by PhpStorm.
 * User: laure
 * Date: 2019-06-16
 * Time: 18:23
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
Use App\Repository\TagRepository;
Use App\Entity\Tag;

/**
 * Class TagController
 * @package App\Controller
 * @Route ("/tag")
 */

class TagController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(TagRepository $tagRepository)
    {

        /*$tag = new Tag();
        $tag->setName('git');
        $em = $this->getDoctrine()->getManager();
        $em->persist($tag);
        $em->flush();*/

        return $this->render('Tag/index.html.twig', [
            'tags' => $tagRepository->findAll(),
        ]);
    }
    /**
     * @Route ("/{name}", name="tag_show", methods={"GET"})
     * @return Response A response instance
     */
    public function show(Tag $tag): Response
    {
        return $this->render('Tag/show.html.twig' ,  [
            'tag' => $tag,
        ]);
    }
}