<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductsController extends Controller
{
    public function oneAction($permalink)
    {
        $repository_products = $this->getDoctrine()->getRepository('SiteMainBundle:Products');

        $product = $repository_products->findOneByPermalink($permalink);
        $products = $repository_products->findAllWithoutParent();
        $products2 = $repository_products->findAll();

        return $this->render('SiteMainBundle:Frontend/Products:index.html.twig', array(
            'products' => $products,
            'products2' => $products2,
            'product' => $product
        ));
    }
}
