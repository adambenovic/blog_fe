<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use App\Handler\AddPostFormHandler;
use App\Handler\CommentFormHandler;
use App\Handler\CommentsHandler;
use App\Handler\EditPostFormHandler;
use App\Handler\PostsHandler;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    private $commentFormHandler;
    private $addPostHandler;
    private $editPostHandler;
    private $postsHandler;
    private $commentsHandler;

    public function __construct(
        CommentFormHandler $commentFormHandler,
        AddPostFormHandler $addPostHandler,
        EditPostFormHandler $editPostHandler,
        PostsHandler $postsHandler,
        CommentsHandler $commentsHandler
    ){
        $this->commentFormHandler = $commentFormHandler;
        $this->addPostHandler = $addPostHandler;
        $this->editPostHandler = $editPostHandler;
        $this->postsHandler = $postsHandler;
        $this->commentsHandler = $commentsHandler;
    }

    /**
     * @Route("/{id}", name="showblog", requirements={"id"="\d+"})
     * @param Request $request The one and only request
     * @param integer $id part of the route
     * @return mixed rendered page
     */
    public function show(Request $request, int $id)
    {
        $blog = $this->postsHandler->getPostByID($id);
        $comments = $this->commentsHandler->getBlogComments($id);
        $form = $this->commentFormHandler->handle($request, $id);

        if ($form == null)
            return $this->redirect($this->generateUrl('showblog', ['id' => $id]));

        return $this->render('blog/show.html.twig', [
            'id' => $id,
            'blog' => $blog,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/add", name="add")
     * @param Request $request The one and only request
     * @return mixed rendered page
     */
    public function post(Request $request)
    {
        $form = $this->addPostHandler->handle($request);

        if ($form === null)
                return $this->redirect($this->generateUrl('myposts'));

        return $this->render('blog/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/myposts", name="myposts")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function myPosts()
    {
        $blogs = $this->postsHandler->getUserPosts();

        return $this->render('blog/myposts.html.twig', [
            'blogs' => $blogs,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="editmypost", requirements={"id"="\d+"})
     * @param Request $request The one and only request
     * @param integer $id part of the route
     * @return mixed rendered page
     */
    public function editMyPost(Request $request, int $id)
    {
        //TODO Load post for editing
        $form = $this->editPostHandler->handle($request, $blog);

        if ($form === null)
            return $this->redirect($this->generateUrl('myposts'));

        return $this->render('blog/edit.html.twig', [
            'blog' => $blog,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="deletemypost", requirements={"id"="\d+"})
     * @param integer $id part of the route
     * @return mixed redirect to users posts
     */
    public function deleteMyPost(int $id)
    {
        //TODO Delete post

        return $this->redirect('/myposts');
    }
}