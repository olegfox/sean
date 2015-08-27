<?php

namespace Site\MainBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Site\MainBundle\Form\FeedbackType;
use Site\MainBundle\Form\Feedback;
use Site\MainBundle\Form\CallbackType;
use Site\MainBundle\Form\Callback;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @param null $slug
     * @return Response
     */
    public function indexAction($slug = null)
    {
        $repository_page = $this->getDoctrine()->getRepository('SiteMainBundle:Page');
        $repository_products = $this->getDoctrine()->getRepository('SiteMainBundle:Products');

        $pages = $repository_page->findAll();
        $products = $repository_products->findAllWithoutParentOnMain();
        $productsRelax = $repository_products->findAllWithoutParentOnRelax();

        return $this->render('SiteMainBundle:Frontend/Main:index.html.twig', array(
            'pages' => $pages,
            'products' => $products,
            'productsRelax' => $productsRelax
        ));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function feedbackAction(Request $request){
        $form = $this->createForm(new FeedbackType(), new Feedback());

        if($request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $swift = \Swift_Message::newInstance()
                    ->setSubject('Сеан (Письмо с сайта)')
                    ->setFrom(array('1991oleg22@gmail.com' => "Письмо с сайта"))
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

        return $this->render('SiteMainBundle:Frontend/Feedback:form.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function callbackAction(Request $request){
        $form = $this->createForm(new CallbackType(), new Callback());

        if($request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $swift = \Swift_Message::newInstance()
                    ->setSubject('Сеан (Обратный звонок)')
                    ->setFrom(array('1991oleg22@gmail.com' => "Новая заявка"))
                    ->setTo(array('1991oleg22@gmail.com'))
                    ->setBody(
                        $this->renderView(
                            'SiteMainBundle:Frontend/Callback:message.html.twig',
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

        return $this->render('SiteMainBundle:Frontend/Callback:form.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
