<?php

namespace MSP\CoreBundle\Controller;

use MSP\CoreBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class ArticleController
 * @package MSP\CoreBundle\Controller
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route("/new", name="msp_core_article_new")
     * @Template()
     */
    public function newAction(Request $request)
    {
        if($request->isMethod('post')) {
            $articleService = $this->get('msp_core.article_service');
            $article = new Article();
            $article->setTitle($request->get('title'));
            $article->setDescription($request->get('description'));
            $articleService->publishArticle($article);

//            $title = $request->get('title');
//            $description = $request->get('description');
//            $article->setTitle($title)
//                     ->setDescription($description);


            return $this->redirect($this->generateUrl('msp_core_article_list'));
        }

        return [];
    }

    /**
     * @Route("/list", name="msp_core_article_list")
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $articles = $em->getRepository("MSPCoreBundle:Article")->findAll();


        return [
            'articles' => $articles,
        ];
    }

    /**
     * @Route("/delete/{id}", name="msp_core_article_delete")
     */
    public function deleteAction($id)
    {
        $articleService = $this->get('msp_core.article_service');
        $articleService->deleteArticle($id);
//        $article = $em->getRepository('MSPCoreBundle:Article')->find($id);
//
//        if(!$article) {
//            throw new NotFoundResourceException('Couldn`t find article entity');
//        }
//
//        $em->remove($article);
//        $em->flush();

        return $this->redirect($this->generateUrl('msp_core_article_list'));
    }
}
