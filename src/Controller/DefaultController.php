<?php
/**
 * Created by PhpStorm.
 * User: laure
 * Date: 2019-05-14
 * Time: 11:23
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
/**
* @Route("/", name="app_index")
*/
    public function index()
    {
        return $this->render('blog/default.html.twig');
    }
}