<?php

// namespace
namespace AdminBundle\Controller;

//entiry classes
use MainBundle\Entity\TherapeuticArea;

//required classes
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\Definition\Exception\Exception;

class TherapeuticAreaController extends Controller
{

	public function indexAction()
	{
		return $this->render('AdminBundle:TherapeuticArea:index.html.twig');
	}

	public function addAction(Request $request)
	{
		try {
				// add therapeutic area
				$doctrine = $this->getDoctrine()->getManager();
				$s_therapeutic_area_name = trim($request->request->get('txt_therapeutic_area'));
				$therapeutic_area = new TherapeuticArea();
				$therapeutic_area->setName($s_therapeutic_area_name);
				$a_error_list   = $this->get('validator')->validate($therapeutic_area);
				$s_error_msg    = "";
				if (count($a_error_list) > 0) {
					foreach ($a_error_list as $err) {
						$s_error_msg.= $err->getMessage() . "\n";
					}
				}
				if($s_error_msg != '') {
					$a_response['s_status'] = 'error';
					$a_response['data']     = $s_error_msg;
				} else {
					// add new in database
					$therapeutic_area = new TherapeuticArea();
					$therapeutic_area->setName($s_therapeutic_area_name);
					$doctrine->persist($therapeutic_area);
					$doctrine->flush();
					$a_response['s_status'] = 'success';
					$a_response['data']     = '';
				}
		} catch(Exception $e) {
			$a_response['s_status'] = 'error';
			$a_response['data']     = $e->getMessage();
		}
		return new JsonResponse($a_response);
	}

	public function editAction(Request $request)
	{
		try {
			$i_therapeutic_area_id = trim($request->request->get('hid_therapeutic_area_id'));
			$doctrine = $this->getDoctrine()->getManager();
			if($i_therapeutic_area_id > 0) {
				// edit therapeutic area
				$s_therapeutic_area_name = trim($request->request->get('txt_edit_therapeutic_area'));
				$therapeutic_area   = $doctrine->getRepository('MainBundle\Entity\TherapeuticArea')->find($i_therapeutic_area_id);
				$therapeutic_area->setName($s_therapeutic_area_name);
				$a_error_list   = $this->get('validator')->validate($therapeutic_area);
				$s_error_msg    = "";
				if (count($a_error_list) > 0) {
					foreach ($a_error_list as $err) {
						$s_error_msg.= $err->getMessage();
					}
				}
				if($s_error_msg != '') {
					$a_response['s_status'] = 'error';
					$a_response['data']     = $s_error_msg;
				} else {
					//update in database
					$therapeutic_area   = $doctrine->getRepository('MainBundle\Entity\TherapeuticArea')->find($i_therapeutic_area_id);
					$therapeutic_area->setName($s_therapeutic_area_name);
					$doctrine->persist($therapeutic_area);
					$doctrine->flush();
					$a_response['s_status'] = 'success';
					$a_response['data']     = '';
				}   
			}
		} catch(Exception $e) {
			$a_response['s_status'] = 'error';
			$a_response['data']     = $e->getMessage();
		}
		return new JsonResponse($a_response);
	}

	public function getListAction()
	{
		try {
			$repository = $this->getDoctrine()->getRepository('MainBundle\Entity\TherapeuticArea');
			$therapeutic_area = $repository->findBy(array(),array('name' => 'ASC'));
			$template = $this->renderView('AdminBundle:TherapeuticArea:list.html.twig',array('therapeutic_area'=> $therapeutic_area));
			$a_response['s_status']     = 'success';
			$a_response['data']         = $template;
			$a_response['i_record']     = count($therapeutic_area);
		} catch(Exception $e) {
			$a_response['s_status'] = 'error';
			$a_response['data']     = $e->getMessage();
		}
		return new JsonResponse($a_response);
	}
}
