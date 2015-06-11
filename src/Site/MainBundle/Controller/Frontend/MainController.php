<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\MainBundle\Form\FeedbackType;
use Site\MainBundle\Form\Feedback;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    public function indexAction($slug = null)
    {
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $repository_products = $this->getDoctrine()->getRepository('SiteMainBundle:Products');

        $pages = $repository_page->findAll();
        $products = $repository_products->findAllWithoutParent();

        return $this->render('SiteMainBundle:Frontend/Main:index.html.twig', array(
            'pages' => $pages,
            'products' => $products
        ));
    }

    public function feedbackAction(Request $request){
        $form = $this->createForm(new FeedbackType(), new Feedback());

        $form->handleRequest($request);

        if($form->isValid()){
            $swift = \Swift_Message::newInstance()
                ->setSubject('Sablin (Новая заявка)')
                ->setFrom(array('1991oleg22@gmail.com' => "Новая заявка"))
                ->setTo(array('1991oleg22@gmail.com'))
                ->setBody(
                    $this->renderView(
                        'SiteMainBundle:Frontend/Feedback:message.html.twig',
                        array(
                            'form' => $form
                        )
                    )
                    , 'text/html'
                );
            $this->get('mailer')->send($swift);

            return new Response('Сообщение успешно отправлено!', 200);
        }

        return new Response('Ошибка!', 500);
    }

    /**
     * Создание формы обратной связи
     *
     * @param Feedback $entity
     * @return \Symfony\Component\Form\Form
     */
    private function createCreateForm(Feedback $entity)
    {
        $form = $this->createForm(new FeedbackType(), $entity);

        return $form;
    }
}
