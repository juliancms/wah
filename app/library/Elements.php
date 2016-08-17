<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Construcción de los elementos UI de la aplicación
 */
class Elements extends Component
{

    private $_headerMenu = array(
            'new' => array(
                'caption' => 'New Receipt',
                'controller' => 'receipt',
                'action' => 'new'
            ),
            'receipts' => array(
                'caption' => 'Receipts',
                'controller' => 'receipt',
                'action' => 'index'
            )
    );

    private $_receiptMenu = array(
		'new' => array(
				'caption' => 'New Receipt',
				'action' => 'new',
				'icon' => 'glyphicon glyphicon-plus'
		),
		'receipts' => array(
				'caption' => 'Receipts',
				'action' => 'index',
				'icon' => 'glyphicon-calendar'
		)
	);

    /**
     * Builds header menu
     *
     * @return string
     */
    public function getMenu()
    {
    	$controllerName = $this->view->getControllerName();
    	$actionName = $this->view->getActionName();
    	echo '<div class="nav-collapse">';
    	echo '<ul class="nav navbar-nav navbar-left">';
    	foreach ($this->_headerMenu as $controller => $option) {
    		if ($actionName == $option['action'] && $controllerName == $option['controller']) {
    			echo '<li class="active">';
    		} else {
    			echo '<li>';
    		}
    		echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $option['caption']);
    		echo '</li>';
    	}
    	echo '</ul>';
    	echo '</div>';
    }

    /**
     * Selects for forms
     */
    public function getSelect($select)
    {
    	switch ($select) {
    		case "category":
    			return array (
    			'1' => 'Lab',
    			'2' => 'Medicine',
    			'3' => 'Admission',
    			'4' => 'Consultation');
    			break;
    		default:
    			return array();
    	}
    }

    /**
     * Builds receipt internal menu
     *
     * @return string
     */
    public function getReceiptmenu()
    {
    	$actionName = $this->view->getActionName();
    	foreach ($this->_receiptMenu as $menu) {
    		$action = $menu['action'];
    		$caption = $menu['caption'];
    		$icon = $menu['icon'];
    		if($actionName == $menu['action']){
    			echo "<a class='btn btn-primary menu-tab disabled'><i class='glyphicon $icon'></i> $caption</a>";
    		} else {
    			echo "<a href='/wah/receipt/$action' class='btn btn-primary menu-tab'><i class='glyphicon $icon'></i> $caption</a>";
    		}
    	}
		echo "<div class='clear'></clear>";
    }
}
