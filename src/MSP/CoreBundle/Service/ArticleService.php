<?php

namespace MSP\CoreBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;
use MSP\CoreBundle\Entity\Article;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Class ArticleService
 * @package MSP\CoreBundle\Service
 * @DI\Service("msp_core.article_service")
 */
class ArticleService
{
private $em;
    /**
     * @DI\InjectParams({
     *     "em" = @DI\Inject("doctrine.orm.entity_manager")
     *
     * })
     */
    public function __construct($em)
    {
        $this->em = $em;
    }

    /**
     * @param Article $article
     */
    public function publishArticle(Article $article)
   {
        $this->em->persist($article);
        $this->em->flush();
   }

    /**
     * @param $id
     * @throws NotFoundResourceException
     */
    public function deleteArticle($id)
   {
       $article = $this->em->getRepository('MSPCoreBundle:Article')->find($id);
       if(!$article) {
           throw new NotFoundResourceException('Couldn`t find article entity');
       }
       $this->em->remove($article);
       $this->em->flush();
   }


}