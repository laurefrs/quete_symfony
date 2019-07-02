<?php
namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ArticleSearchType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CategoryType;

/**
 * @Route("/blog")
 * @return Response A response instance
 */

class BlogController extends AbstractController
{
/**
* Show all row from article's entity
*
* @Route("/", name="blog_index")
* @return Response A response instance
*/
public function index(): Response
{
    $categories = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findAll();


    /*if (!$articles) {
        /*throw $this->createNotFoundException(
         'No article found in article\'s table.'
        );
        }*/

    $formArticle = $this->createForm(ArticleSearchType::class, null,
        ['method' => Request::METHOD_GET]
    );

    return $this->render(
        'blog/index.html.twig',
         ['categories' => $categories,
             'formArticle'=>$formArticle->createView(),

         ]
        );
}

/**
 * @Route("/category/{name}", name="show_category")
 *
 * @return Response A response instance
 */
public function showByCategory(Category $category) : Response
{
    /*$category = $this->getDoctrine()
        ->getRepository(Category::class)
        ->findOneBy(['name'=>$categoryName]);*/

    /*$articles = $this->getDoctrine()
        ->getRepository(Article::class)
        ->findBy(['category'=>$category],['id'=>'DESC'],3);*/

    $articles = $category->getArticles();

    return $this->render(
        'blog/category.html.twig',
        [
            'category' => $category,
            'articles' => $articles
        ]
    );

}
/**
* Getting a article with a formatted slug for title
*
* @param string $slug The slugger
*
* @Route("/{slug<^[a-z0-9-]+$>}",
*     defaults={"slug" = null},
*     name="blog_show")
*  @return Response A response instance
*/
    public function show(?string $slug) : Response
    {
    if (!$slug) {
        throw $this
            ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
    }

    $slug = preg_replace(
        '/-/',
        ' ', ucwords(trim(strip_tags($slug)), "-")
    );

    $article = $this->getDoctrine()
        ->getRepository(Article::class)
        ->findOneBy(['title' => mb_strtolower($slug)]);

    if (!$article) {
        throw $this->createNotFoundException(
            'No article with '.$slug.' title, found in article\'s table.'
        );
    }

    return $this->render(
        'blog/show.html.twig',
        [
            'article' => $article,
            'slug' => $slug,
        ]
    );
    }


}
