<?php

namespace App\Controller;

use App\Handler\CommentsHandler;
use App\Handler\ContactFormHandler;
use App\Handler\PostsHandler;
use App\Service\ApiClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomePageController extends Controller
{
    private $contactHandler;
    private $postsHandler;
    private $commentsHandler;

    public function __construct(
        ContactFormHandler $contactHandler,
        PostsHandler $postsHandler,
        CommentsHandler $commentsHandler

    ){
        $this->contactHandler = $contactHandler;
        $this->postsHandler = $postsHandler;
        $this->commentsHandler = $commentsHandler;
    }

    /**
     * @Route("/", name="homepage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $blogs = $this->postsHandler->getHomepagePosts();

        return $this->render('homepage/index.html.twig', [
            'blogs' => $blogs
        ]);
    }
  
    /**
     * @Route("/about", name="about")
     * @return mixed rendered page
     */
    public function about()
    {
        return $this->render('about/about.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     * @param Request $request The one and only request
     * @return mixed rendered page
     */
    public function contact(Request $request)
    {
        $form = $this->contactHandler->handle($request);

        if($form === null)
            return $this->redirect('contact');

        return $this->render('contact/contact.html.twig', array(
            'form' => $form->createView()
        ));
    }
  
    /**
     * @Route("/search", name="search")
     * @param Request $request The one and only request
     * @return mixed rendered page
     */
    public function search(Request $request) {
        $blogs = $this->postsHandler->getSearchPosts($request);

        return $this->render('search/search.html.twig', array(
            'blogs' => $blogs
        ));
    }

    /**
     * @Route("/sidebar", name="sidebar")
     * @return mixed rendered page
     */
    public function sidebar()
    {
        $comments = $this->commentsHandler->getHomepageComments();

        return $this->render('sidebar/sidebar.html.twig', array(
            'comments' => $comments
        ));
    }

    /**
     * @Route("/game", name="game")
     * @return mixed rendered page
     */
    public function game()
    {
        return $this->render('game/game.html.twig');
    }
}