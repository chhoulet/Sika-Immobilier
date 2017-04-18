<?php  

namespace BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MessageController extends Controller
{
	public function listAction()
	{
		$em=$this->getDoctrine()->getmanager();
		$listMessages=$em->getRepository('FrontOfficeBundle:Message')->findAll();

		return $this->render('BackOfficeBundle:Message:list.html.twig', array('listMessages' =>$listMessages));
	}

	public function readMessageAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getmanager();
		$session=$request->getSession();
		$listAllMessages=$em->getRepository('FrontOfficeBundle:Message')->findAll();

		$listIdMessages=array();
		foreach($listAllMessages as $message)
		{
			$idMessage=$message->getId();
			$listIdMessages[]=$idMessage;
		}

		$readMessage=$em->getRepository('FrontOfficeBundle:Message')->find($id);

		if($readMessage != null)
		{
			if(in_array($id, $listIdMessages))
			{
				$readMessage->setState(2);
				$readMessage->setDateAnswered(null);
				$em->flush();

				$session->getFlashBag()->add('readMessage','Ce message est marqué en lu !');
				return $this->redirectToRoute('back_message_list');
			}
			else
			{
				throw new NotFoundHttpException("Message inexistant !");			
			}			
		}
		else
		{
			throw new NotFoundHttpException("Message inexistant !");
		}
	}

	public function unreadMessageAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getmanager();
		$session=$request->getSession();
		$listAllMessages=$em->getRepository('FrontOfficeBundle:Message')->findAll();

		$listIdMessages=array();
		foreach($listAllMessages as $message)
		{
			$idMessage=$message->getId();
			$listIdMessages[]=$idMessage;
		}

		$unreadMessage=$em->getRepository('FrontOfficeBundle:Message')->find($id);

		if($unreadMessage != null)
		{
			if(in_array($id, $listIdMessages))
			{
				$unreadMessage->setState(1);
				$unreadMessage->setDateAnswered(null);
				$em->flush();

				$session->getFlashBag()->add('unreadMessage','Ce message est marqué en non-lu !');
				return $this->redirectToRoute('back_message_list');
			}
			else
			{
				throw new NotFoundHttpException("Message inexistant !");			
			}			
		}
		else
		{
			throw new NotFoundHttpException("Message inexistant !");
		}
	}


	public function answeredMessageAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getmanager();
		$session=$request->getSession();
		$listAllMessages=$em->getRepository('FrontOfficeBundle:Message')->findAll();

		$listIdMessages=array();
		foreach($listAllMessages as $message)
		{
			$idMessage=$message->getId();
			$listIdMessages[]=$idMessage;
		}

		$answeredMessage=$em->getRepository('FrontOfficeBundle:Message')->find($id);

		if($answeredMessage != null)
		{
			if(in_array($id, $listIdMessages))
			{
				$answeredMessage->setState(3);
				$answeredMessage->setDateAnswered(new \DateTime());
				$em->flush();

				$session->getFlashBag()->add('answeredMessage','Réponse envoyée !');
				return $this->redirectToRoute('back_message_list');
			}
			else
			{
				throw new NotFoundHttpException("Message inexistant !");			
			}			
		}
		else
		{
			throw new NotFoundHttpException("Message inexistant !");
		}
	}

	public function unAnsweredMessageAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getmanager();
		$session=$request->getSession();
		$listAllMessages=$em->getRepository('FrontOfficeBundle:Message')->findAll();

		$listIdMessages=array();
		foreach($listAllMessages as $message)
		{
			$idMessage=$message->getId();
			$listIdMessages[]=$idMessage;
		}

		$unansweredMessage=$em->getRepository('FrontOfficeBundle:Message')->find($id);

		if($unansweredMessage != null)
		{
			if(in_array($id, $listIdMessages))
			{
				$unansweredMessage->setState(2);
				$unansweredMessage->setDateAnswered(null);
				$em->flush();

				$session->getFlashBag()->add('unansweredMessage','Aucune réponse envoyée !');
				return $this->redirectToRoute('back_message_list');
			}
			else
			{
				throw new NotFoundHttpException("Message inexistant !");			
			}			
		}
		else
		{
			throw new NotFoundHttpException("Message inexistant !");
		}
	}

	public function deleteAction(Request $request, $id)
	{
		$em=$this->getDoctrine()->getManager();
		$session=$request->getSession();
		$deleteMessage=$em->getRepository('FrontOfficeBundle:Message')->find($id);

		// Controle de l'existence de l'id :
		$listMessages=$em->getRepository('FrontOfficeBundle:Message')->findAll();
		$listIdmessages=array();
		foreach($listMessages as $message)
		{
			$idmessage=$message->getId();
			$listIdMessages[]=$idmessage;
		}

		if($deleteMessage != null && in_array($id, $listIdMessages))
		{
			$em->remove($deleteMessage);
			$em->flush();

			$session->getFlashbag()->add('deleteMessage','Ce message est supprimé !');
			return $this->redirectToRoute('back_message_list');
		}
		else
		{
			throw new NotFoundHttpException("Message inexistant !");
		}
	}
}