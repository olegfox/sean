<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductsController extends Controller
{
    public function oneAction($permalink, $slug)
    {
        $repository_products = $this->getDoctrine()->getRepository('SiteMainBundle:Products');

        $product = $repository_products->findOneByPermalink($permalink);
        $products = $repository_products->findAllWithoutParent();
        $products2 = $repository_products->findAll();

        $params = array(
            'products' => $products,
            'products2' => $products2,
            'product' => $product
        );

        if(!is_null($slug)){
            $repository_elements = $this->getDoctrine()->getRepository('SiteMainBundle:Element');

            $element = $repository_elements->findOneBySlug($slug);

            $params = array_merge($params, array(
                'element' => $element
            ));
        }

        return $this->render('SiteMainBundle:Frontend/Products:index.html.twig', $params);
    }
}
