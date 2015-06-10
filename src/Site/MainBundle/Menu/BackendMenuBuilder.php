<?php

namespace Site\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class BackendMenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        $menu->addChild('Страницы', array('route' => 'backend_page_index'));
        $menu->addChild('Фото в биографии', array('route' => 'backend_photo_biography_index'));
        $menu->addChild('Новости', array('route' => 'backend_news_index'));
        $menu->addChild('Комментарии', array('route' => 'backend_comments_index'));
        $menu->addChild('Медиа', array('route' => 'backend_media_index'));

        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Выход', array('route' => 'fos_user_security_logout'));

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        return $menu;
    }
}