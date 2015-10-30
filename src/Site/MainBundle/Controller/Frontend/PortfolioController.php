<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PortfolioController extends Controller
{
    public function indexAction($slug = null)
    {
        $repository_portfolio = $this->getDoctrine()->getRepository('SiteMainBundle:Portfolio');
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');

        $portfolio = $repository_portfolio->findAll();
        $page = $repository_page->findOneBy(array('slug' => 'portfolio'));

        $params = array(
            'portfolio' => $portfolio,
            'page' => $page
        );

        if(!is_null($slug)){
            $portfolioOne = $repository_portfolio->findOneBy(array('slug' => $slug));

            if(!$portfolioOne){
                throw $this->createNotFoundException('Портфолио не найдено');
            }

            $params = array_merge($params, array(
                'portfolioOne' => $portfolioOne
            ));
        }

        return $this->render('SiteMainBundle:Frontend/Portfolio:index.html.twig', $params);
    }

    public function oneContentAction($slug = null)
    {
        $repository_portfolio = $this->getDoctrine()->getRepository('SiteMainBundle:Portfolio');

        $portfolioOne = $repository_portfolio->findOneBy(array('slug' => $slug));

        if(!$portfolioOne){
            throw $this->createNotFoundException('Портфолио не найдено');
        }

        $params = array(
            'portfolioOne' => $portfolioOne
        );

        return $this->render('SiteMainBundle:Frontend/Portfolio:content.html.twig', $params);
    }
}
