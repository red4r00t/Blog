<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index", defaults={"page" = 1})
     * @Route("/page/{page}", name="index_paginated", requirements={"page" : "\d+"})
     */
    public function indexAction($page)
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->getAllPosts($page, Post::NUM_ITEMS);
        $pages = ceil($posts->count() / Post::NUM_ITEMS);

        return $this->render('default/index.html.twig', array(
            'page' => $page,
            'pages' => $pages,
            'posts' => $posts
        ));
    }

    /**
     * @Route("/post/{slug}", name="index_post_show")
     */
    public function showAction(Post $post)
    {
        return $this->render('default/show.html.twig', array(
            'post' => $post
        ));
    }
}