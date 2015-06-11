<?php

namespace Site\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class FrontendMenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $request = $this->container->get('request');

        $routeName = $request->get('_route');

        $em = $this->container->get('doctrine.orm.entity_manager');

        $repository = $em->getRepository('SiteMainBundle:Page');

        $menus = $repository->findBy(array('parent' => null), array('position' => 'asc'));

        $menu = $factory->createItem('root');

//        $menu->setChildrenAttribute('class', 'nav nav-pills black');

        foreach ($menus as $key => $m) {
            if($key == 0){
                $menu
                    ->addChild($m->getTitle(), array(
                        'route' => 'frontend_homepage'
                    ));
            }else{
                $menu
                    ->addChild($m->getTitle(), array(
                        'route' => 'frontend_page_index',
                        'routeParameters' => array('slug' => $m->getSlug())
                    ));
            }
        }

        $menu->addChild("", array(
            'route' => "",
            'routeParameters' => "",
            'linkAttributes' => array(),
        ))->setLabel("");

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        return $menu;
    }
}