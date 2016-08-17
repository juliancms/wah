<?php
use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\DI\FactoryDefault;

class Receipt extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $category;

    /**
     *
     * @var integer
     */
    public $number;

    /**
     *
     * @var string
     */
    public $date;

    /**
     *
     * @var integer
     */
    public $amount;

    /**
     *
     * @var string
     */
    public $datetime;

    public function initialize()
    {
    	$this->addBehavior(new Timestampable(array(
    			'beforeValidationOnCreate' => array(
    					'field' => 'datetime',
    					'format' => 'Y-m-d H:i:s'
    			)
    	)));
    }

    /**
     * Returns a human representation of 'category'
     *
     * @return string
     */
    public function getCategory()
    {
    	switch ($this->category) {
    		case 0:
    			return "Default";
    			break;
    		case 1:
    			return "Lab";
    			break;
    		case 2:
    			return "Medicine";
    			break;
    		case 3:
    			return "Admission";
    			break;
    		case 4:
    			return "Consultation";
    			break;
    	}
    }

    /**
     * Returns a human representation of 'date'
     *
     * @return string
     */
    public function getDate()
    {
      return date("d/m/Y", strtotime($this->date));
    }
    
}
