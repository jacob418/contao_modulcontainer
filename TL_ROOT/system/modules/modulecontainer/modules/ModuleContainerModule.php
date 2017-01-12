<?php

namespace Contao;

class ModuleContainerModule extends \Module{

	protected $strTemplate = 'mod_containermodule' ;

	public function generate(){
		if (TL_MODE == 'BE'){
			/** @var \BackendTemplate|object $objTemplate */
			$objTemplate = new \BackendTemplate('be_wildcard');
			$objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['containermodule'][0]) . ' ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;
			return $objTemplate->parse();
		}

		$this->containermodule_moduleList = unserialize($this->containermodule_moduleList) ;

		return parent::generate();
	}


	protected function compile(){
		$arrModules = array() ;

		foreach($this->containermodule_moduleList as $module){
			$name = $module["name"] ;
			$objModule = \ModuleModel::findByPk($module["id"]) ;

			if($objModule !== null){
				$arrModules[$name] = $this->getFrontendModule($objModule, $this->strColumn) ;
			}
		}

		$templateName = $this->containermodule_container_template ;
		if($templateName == ""){
			$templateName = "container_default" ;
		}

		$objTemplate = new \FrontendTemplate($templateName) ;
		$objTemplate->setData($arrModules) ;
		$objTemplate->moduleList = $this->containermodule_moduleList ;
		$this->Template->output = $objTemplate->parse() ;
	}
}
