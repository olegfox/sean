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

        return $this->render('SiteMainBundle:Frontend/Products:index.html.twig', array(
            'products' => $products,
            'product' => $product
        ));
    }
}
