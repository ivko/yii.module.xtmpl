<?php
/**
 * Parent class for some simple controllers (see default as example)
 */
class XbaseController extends CController
{
  /**
   * @var string project xsl view path
   */
  protected $xslViewPath = null;
  /**
   * @var ViewContext $view
   */
  protected $view = null;

  public function __construct($id, $module = null)
  {
    parent::__construct($id, $module);
    if (!($module instanceof XtmplModule)) {
      Yii::app();
      new XtmplModule('xtmpl', $module);
    }
    $this->view = new ViewContext($this);
    $this->xslViewPath = DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'xsl';
  }

  /**
   *  Get active yii-xslt widgets DTD
   */
  public function actionIndex()
  {
    echo <<<EOT
    <?xml version="1.0" encoding="UTF-8"?'>
<!ELEMENT tmpl (param*)>
<!ATTLIST tmpl
	type NMTOKEN #REQUIRED
	name CDATA #IMPLIED
	id NMTOKEN #IMPLIED
>
<!ELEMENT widget (param*)>
<!ATTLIST widget
	type NMTOKEN #REQUIRED
>
<!ELEMENT param (#CDATA | option)*>
<!ATTLIST param
	name NMTOKEN #REQUIRED
>
<!ELEMENT option (#CDATA | option)*>
<!ATTLIST option
	name NMTOKEN #IMPLIED
>
EOT;
    //Yii::app()->end();
  }

  /**
   * Processes the request using another controller action and return output.
   *
   * @param string $route the route of the new controller action. This can be an action ID, or a complete route
   * with module ID (optional in the current module), controller ID and action ID. If the former, the action is assumed
   * to be located within the current controller.
   * @return string output
   */
  public function execute($route)
  {
    $get = $_GET;
    ob_start();
    $this->forward($route, false);
    $out = ob_get_clean();
    $_GET = $get;
    return $out;
  }

  /**
   * Get|Set data to view context ( like jquery $.val() $.val('newvval') )
   * @param null $key
   * @param null $value
   * @return mixed|array|null
   */
  public function view($key = null, $value = null)
  {

    if ($value === null) {

      if ($key === null)
        return $this->view->getData();
      else
        return $this->view->$key;

    } else {

      if ($key !== null)
        $this->view->set($key, $value);
    }
  }

  /**
   * @param $viewName
   * @return string
   */
  public function getViewFile($viewName)
  {

    if (!parent::getViewFile($viewName)) {
      if (($module = $this->getModule()) === null) {
        $module = Yii::app();
      }
      $module->setViewPath($module->getBasePath() . $this->xslViewPath);
    }
    return parent::getViewFile($viewName);
  }

  /**
   *
   * @param $view
   * @param null $data
   * @param bool $return
   * @return string
   */
  public function render($view, $data = null, $return = false)
  {
    $data = $data ? (array)$data : array();
    $data = CMap::mergeArray($this->view->getData(), $data);
    return parent::render($view, $data, $return);
  }

  /**
   * @param $view
   * @return bool
   */
  protected function beforeRender($view)
  {
    return parent::beforeRender($view);
  }

}