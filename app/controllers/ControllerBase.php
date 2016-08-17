<?php
use Phalcon\Mvc\Controller;
class ControllerBase extends Controller
{
	/**
	 * Title
	 */
    protected function initialize()
    {
        $this->tag->prependTitle('AHS - Waterloo | ');
        $this->view->setTemplateAfter('main');
    }
    protected function forward($uri)
    {
    	$uriParts = explode('/', $uri);
    	$params = array_slice($uriParts, 2);
    	return $this->dispatcher->forward(
    			array(
    					'controller' => $uriParts[0],
    					'action' => $uriParts[1],
    					'params' => $params
    			)
    	);
    }
}
