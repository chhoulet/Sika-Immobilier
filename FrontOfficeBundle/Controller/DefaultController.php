<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function homepageAction()
    {
    	$em=$this->getDoctrine()->getManager();
    	$listArticles=$em->getRepository('FrontOfficeBundle:Article')->findAll();
        $listProjects=$em->getRepository('FrontOfficeBundle:Project')->findByActive(1);

    	//Sélection du dernier article créé par le timestamp
    	$listTimeStamps=array();
    	foreach($listArticles as $article)
    	{
    		$valueStamp=$article->getDateCreated();
    		$listTimeStamps[]=$valueStamp;
    	}
    	rsort($listTimeStamps);
    	$articleTime=array_pop($listTimeStamps);

    	$articleHomepage=array();
    	foreach($listArticles as $articlet)
    	{
    		$timestampArticle=$articlet->getDateCreated();
    		if($timestampArticle == $articleTime)
    		{    			
    			$articleHomepage[]=$articlet;
    		}
    	}

        return $this->render('FrontOfficeBundle:Default:homepage.html.twig', 
            array('articles'=>$articleHomepage,
                  'listProjects'=>$listProjects));
    }
}
