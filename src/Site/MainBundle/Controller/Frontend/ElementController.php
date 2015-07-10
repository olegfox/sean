<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ElementController extends Controller
{
    /**
     * Get content element
     *
     * @param $slug
     * @return Response
     */
    public function contentAction($slug)
    {
        $repository_element = $this->getDoctrine()->getRepository('SiteMainBundle:Element');

        $element = $repository_element->findOneBySlug($slug);

        $params = array(
            'element' => $element
        );

        return $this->render('SiteMainBundle:Frontend/Element:content.html.twig', $params);
    }
}
