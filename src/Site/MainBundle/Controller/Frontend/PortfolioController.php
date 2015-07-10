<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PortfolioController extends Controller
{
    public function indexAction()
    {
        $repository_portfolio = $this->getDoctrine()->getRepository('SiteMainBundle:Portfolio');
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');

        $portfolio = $repository_portfolio->findAll();
        $page = $repository_page->findOneBy(array('slug' => 'portfolio'));

        $params = array(
            'portfolio' => $portfolio,
            'page' => $page
        );

        return $this->render('SiteMainBundle:Frontend/Portfolio:index.html.twig', $params);
    }
}
