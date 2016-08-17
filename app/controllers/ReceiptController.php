<?php

use Phalcon\Mvc\Model\Criteria;

class ReceiptController extends ControllerBase
{
    public function initialize()
    {
    	$this->tag->setTitle("Receipt");
        parent::initialize();
    }

    public function indexAction()
    {
      $receipt = Receipt::find(array("group" => "date"));
    	if (count($receipt) == 0) {
    		$this->flash->notice("It has not added any receipts so far");
    		$receipt = null;
    	}
    	$this->view->receipt = $receipt;
    }

    public function dateAction($date)
    {
      if(!$date){
    		return $this->response->redirect("receipt/index");
    	}
      $receipt = Receipt::find(array("date = '$date'", "order" => "number DESC"));
    	if (count($receipt) == 0) {
    		$this->flash->notice("There are no receipts for this date");
    		$receipt = null;
    	}
    	$this->view->receipt = $receipt;
      $this->view->date = date("l, d/m/Y", strtotime($date));
      $this->view->total = Receipt::sum(array("column" => "amount", "conditions" => "date = '$date'"));
      $this->view->lab = Receipt::sum(array("column" => "amount", "conditions" => "date = '$date' AND category = 1"));
      $this->view->medicine = Receipt::sum(array("column" => "amount", "conditions" => "date = '$date' AND category = 2"));
      $this->view->admission = Receipt::sum(array("column" => "amount", "conditions" => "date = '$date' AND category = 3"));
      $this->view->consultation = Receipt::sum(array("column" => "amount", "conditions" => "date = '$date' AND category = 4"));
    }

    public function newAction()
    {
      $this->assets
    	->addJs('js/parsley.min.js')
			->addJs('js/autoNumeric.js')
			->addJs('js/bootstrap-select.js');
      $this->view->category = $this->elements->getSelect("category");
    }

    public function saveAction()
    {
    	if (!$this->request->isPost()) {
    		return $this->response->redirect("receipt/");
    	}
      $number = $this->request->getPost("number");
      $duplicate = Receipt::find(array("number = $number"));
      if($duplicate){
        $this->flash->error("You can not add the receipt because one already exists with the same number, please use another number or delete the receipt that has that number");
        return $this->response->redirect("receipt/new");
      }
    	$receipt = new Receipt();
      $receipt->category = $this->request->getPost("category");
      $receipt->number = $number;
      $receipt->date = date('Y-m-d');
    	$receipt->amount = str_replace(".","",$this->request->getPost("amount"));
    	if (!$receipt->save()) {
    		foreach ($receipt->getMessages() as $message) {
    			$this->flash->error($message);
    		}
    		return $this->response->redirect("receipt/new");
    	}
    	$this->flash->success("The receipt was saved successfully");
    	return $this->response->redirect("receipt/");
    }

    /**
     * Elimina un  receipt
     *
     * @param int $id_periodo
     */
    public function deleteAction($id)
    {
        $receipt = Receipt::findFirstByid($id);
        if (!$receipt) {
            $this->flash->error("The receipt was not found");

            return $this->response->redirect("receipt/");
        }
        if (!$receipt->delete()) {
            foreach ($receipt->getMessages() as $message) {
                $this->flash->error($message);
            }
           	return $this->response->redirect("receipt");
        }
        $this->flash->success("The receipt was removed successfully");
        return $this->response->redirect("receipt/");
    }
}
