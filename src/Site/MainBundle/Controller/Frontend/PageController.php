<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction($slug)
    {
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $page = $repository_page->findOneBy(array('slug' => $slug));

        if(!$page){
            throw $this->createNotFoundException('Страница не найдена');
        }

        $params = array(
            'page' => $page
        );

        return $this->render('SiteMainBundle:Frontend/Page:index.html.twig', $params);
    }
}
