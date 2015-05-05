<?php

// namespace
namespace AdminBundle\Controller;

//entiry classes
use MainBundle\Entity\Msl;

//required classes
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Config\Definition\Exception\Exception;

class MslController extends Controller
{

	public function indexAction()
	{
		return $this->render('AdminBundle:Msl:index.html.twig');
	}

	public function addAction(Request $request)
	{
		try {
			$doctrine = $this->getDoctrine()->getManager();
			// add msl
			$s_msl_first_name 	= trim($request->request->get('txt_first_name'));
			$s_msl_last_name 	= trim($request->request->get('txt_last_name'));
			$s_msl_email 		= trim($request->request->get('txt_email'));
			$msl = new Msl();
			$msl->setFirstName($s_msl_first_name);
			$msl->setLastName($s_msl_last_name);
			$msl->setEmail($s_msl_email);
			$a_error_list   = $this->get('validator')->validate($msl);
			$s_error_msg    = "";
			if (count($a_error_list) > 0) {
				foreach ($a_error_list as $err) {
					$s_error_msg.= $err->getMessage();
					break;
				}
			}
			if($s_error_msg != '') {
				$a_response['s_status'] = 'error';
				$a_response['data']     = $s_error_msg;
			} else {
				//store in database
				$msl = new Msl();
				$msl->setFirstName($s_msl_first_name);
				$msl->setLastName($s_msl_last_name);
				$msl->setEmail($s_msl_email);
				$msl->setGender('Male');
				$msl->setRole('MSL');
				$msl->setMslTerritory('');
				$msl->setTherapeuticArea('');
				$doctrine->persist($msl);
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
			$doctrine = $this->getDoctrine()->getManager();
			$i_msl_id = trim($request->request->get('hid_msl_id'));
			// edit msl
			if($i_msl_id > 0) {
				$a_edit_msl = $request->request->get('edit_msl');
				$s_edit_first_name 		= trim($a_edit_msl['firstName']);
				$s_edit_last_name 		= trim($a_edit_msl['lastName']);
				$s_edit_email 			= trim($a_edit_msl['email']);
				$s_edit_gender 			= trim($a_edit_msl['gender']);
				$s_edit_role 			= trim($a_edit_msl['role']);
				$s_edit_territory_name 	= trim($a_edit_msl['mslTerritory']);
				$msl = $doctrine->getRepository('MainBundle\Entity\Msl')->find($i_msl_id);
				$msl->setFirstName($s_edit_first_name);
				$msl->setLastName($s_edit_last_name);
				$msl->setEmail($s_edit_email);
				$a_error_list   = $this->get('validator')->validate($msl);
				$s_error_msg    = "";
				if (count($a_error_list) > 0) {
					foreach ($a_error_list as $err) {
						$s_error_msg.= $err->getMessage();
						break;
					}
				}
				if($s_error_msg != '') {
					$a_response['s_status'] = 'error';
					$a_response['data']     = $s_error_msg;
				} else {
					//Therapeutical Areas Assigning
					$a_therapeutical_areas = $request->request->get('chk_therapeutic_area');
					$s_therapeutical_areas = '';
					if($a_therapeutical_areas) {
						$s_therapeutical_areas = implode(',', $a_therapeutical_areas);
					}
					//update in database
					$msl = $doctrine->getRepository('MainBundle\Entity\Msl')->find($i_msl_id);
					$msl->setFirstName($s_edit_first_name);
					$msl->setLastName($s_edit_last_name);
					$msl->setEmail($s_edit_email);
					$msl->setGender($s_edit_gender);
					$msl->setRole($s_edit_role);
					$msl->setMslTerritory($s_edit_territory_name);
					$msl->setTherapeuticArea($s_therapeutical_areas);
					$doctrine->persist($msl);
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
			$repository = $this->getDoctrine()->getRepository('MainBundle\Entity\Msl');
			$msl = $repository->findBy(array(),array('firstName' => 'ASC'));
			$template = $this->renderView('AdminBundle:Msl:list.html.twig',array('msl'=> $msl));
			$a_response['s_status'] = 'success';
			$a_response['data']     = $template;
			$a_response['i_record']  = count($msl);
		} catch(Exception $e) {
			$a_response['s_status'] = 'error';
			$a_response['data']     = $e->getMessage();
		}
		return new JsonResponse($a_response);	
	}

	public function getMslDetailsAction(Request $request)
	{
		try {	
			$i_msl_id = trim($request->request->get('msl_id'));
			$msl = $this->getDoctrine()->getRepository('MainBundle\Entity\Msl')->find($i_msl_id);
			// get therapeutic area list
			$repository = $this->getDoctrine()->getRepository('MainBundle\Entity\TherapeuticArea');
			$therapeutic_area = $repository->findBy(array(),array('name' => 'ASC'));
			$a_user_therapeutic_area = array();
			if($msl->getTherapeuticArea() != '') {
				$a_user_therapeutic_area = explode(',', $msl->getTherapeuticArea());
			}
			//edit form
       		$form = $this->createForm('edit_msl', $msl);
			$template = $this->renderView('AdminBundle:Msl:edit.html.twig',
						array('msl'						=> $msl,
							  'therapeutic_area'		=> $therapeutic_area,
							  'a_user_therapeutic_area'	=> $a_user_therapeutic_area,
							  'form'					=> $form->createView()
						));
			$a_response['s_status'] = 'success';
			$a_response['data']     = $template;
		} catch(Exception $e) {
			$a_response['s_status'] = 'error';
			$a_response['data']     = $e->getMessage();
		}
		return new JsonResponse($a_response);
	}

	public function deleteMslAction(Request $request)
	{
		try {
			$i_msl_id = trim($request->request->get('msl_id'));
			$doctrine = $this->getDoctrine()->getManager();
			$msl = $this->getDoctrine()->getRepository('MainBundle\Entity\Msl')->find($i_msl_id);
			$doctrine->remove($msl);
			$doctrine->flush();
			$a_response['s_status'] = 'success';
			$a_response['data']     = '';
		} catch(Exception $e) {
			$a_response['s_status'] = 'error';
			$a_response['data']     = $e->getMessage();
		}
		return new JsonResponse($a_response);
	}
}
