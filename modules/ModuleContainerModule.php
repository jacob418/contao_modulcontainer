<?php

namespace Contao;

class ModuleContainerModule extends \Module{

	protected $strTemplate = 'mod_containermodule'

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

		return parent::generate();
	}


	protected function compile(){
		$arrModules = array() ;

		foreach($this->containermodule_moduleList as $module){
			$name = $module->name ;
			$objModule = \ModuleModel::findByPk($module->id) ;

			if ($objModule !== null)
			{
				$objModule->typePrefix = 'ce_' ;
				$arrModules[$module->name] = $objModule->generate() ;
			}
		}

		$objTemplate = new \FrontendTemplate($this->containermodule_container_template) ;
		$objTemplate->setData($arrModules) ;
		$objTemplate->moduleList = $this->containermodule_moduleList ;
		$this->Template->output = $objTemplate->parse() ;
	}
}
