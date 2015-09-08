<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class OurWorkElementController extends Controller
{
    /**
     * Get content our_work_element
     *
     * @param $slug
     * @return Response
     */
    public function contentAction($slug)
    {
        $repository_our_work_element = $this->getDoctrine()->getRepository('SiteMainBundle:OurWorkElement');

        $ourWorkElement = $repository_our_work_element->findOneBySlug($slug);

        $params = array(
            'ourWorkElement' => $ourWorkElement
        );

        return $this->render('SiteMainBundle:Frontend/OurWorkElement:content.html.twig', $params);
    }
}
