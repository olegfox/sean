<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductsController extends Controller
{
    public function oneAction(Request $request, $permalink, $slug)
    {
        $repository_products = $this->getDoctrine()->getRepository('SiteMainBundle:Products');

        $product = $repository_products->findOneByPermalink($permalink);
        if(!is_object($product)){
            $product = $repository_products->findOneBySlug($permalink);
        }
        $products = $repository_products->findAllWithoutParent();

        $params = array(
            'products' => $products,
            'product' => $product
        );

        if(!is_null($slug)){
            $routeName = $request->get('_route');

            if($routeName == "frontend_our_work_element_one"){
                $repository_our_work_elements = $this->getDoctrine()->getRepository('SiteMainBundle:OurWorkElement');

                $ourWorkElement = $repository_our_work_elements->findOneBySlug($slug);

                $params = array_merge($params, array(
                    'ourWorkElement' => $ourWorkElement
                ));
            }elseif($routeName == "frontend_element_one"){
                $repository_elements = $this->getDoctrine()->getRepository('SiteMainBundle:Element');

                $element = $repository_elements->findOneBySlug($slug);

                $params = array_merge($params, array(
                    'element' => $element
                ));
            }
        }

        return $this->render('SiteMainBundle:Frontend/Products:index.html.twig', $params);
    }
}
