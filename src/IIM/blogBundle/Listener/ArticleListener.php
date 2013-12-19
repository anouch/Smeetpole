<?php
/**
 * Created by PhpStorm.
 * User: Clara
 * Date: 17/12/13
 * Time: 12:36
 */

namespace IIM\blogBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use IIM\blogBundle\Entity\Article;

class ArticleListener {
    protected $container;

    public function __construct($container){
        $this->container = $container;
    }

    public function prePersist(LifecycleEventArgs $args){
        $entity = $args->getEntity();

        //Agir seulement sur l'article
        if($entity instanceof Article){
            $entity->setAuthor($this->container->get('security.context')->getToken()->getUser()); // Met une date de mise à jour quand j'edit un article

        }
    }


} 