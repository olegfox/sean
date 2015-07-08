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
//        $menu->addChild('Фото в биографии', array('route' => 'backend_photo_biography_index'));
        $menu->addChild('Продукты', array('route' => 'backend_products_index'));
        $menu->addChild('Блоки в продуктах', array('route' => 'backend_block_index'));
        $menu->addChild('Элементы блоков в продуктах', array('route' => 'backend_element_index'));
//        $menu->addChild('Комментарии', array('route' => 'backend_comments_index'));
//        $menu->addChild('Медиа', array('route' => 'backend_media_index'));

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