<?php

$GLOBALS['TL_DCA']['tl_module']['palettes']['containermodule']    = '{title_legend},name,headline,type;{config_legend},containermodule_moduleList;{template_legend:hide},container_template,customTpl;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';



$GLOBALS['TL_DCA']['tl_module']['fields']['containermodule_moduleList'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['containermodule_moduleList'],
	'exclude'                 => true,
	'inputType'               => 'multiColumnWizard',
	'eval'					  => array(
			'columnFields'	=>	array(
					'id' => array(
							'label'				=>	&$GLOBALS['TL_LANG']['tl_content']['module'],
							'exclude'			=>	true,
							'inputType'			=>	'select',
							'options_callback'	=>	array('tl_module_containermodule', 'getModules'),
							'eval'				=>	array(
									'mandatory'			=>true,
									'chosen'			=>true
								)
						),
		            'name' => array(
			                'label'			=> &$GLOBALS['TL_LANG']['tl_module']['containermodule_name'],
			                'exclude'		=> true,
			                'inputType'		=> 'text',
			                'eval'			=> array('rgxp'=>'alias')
		                )
				)
		),
	'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['containermodule_container_template'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['containermodule_container_template'],
	'default'                 => 'news_latest',
	'exclude'                 => true,
	'inputType'               => 'select',
	'options_callback'        => array('tl_module_containermodule', 'getContainerTemplates'),
	'eval'                    => array('tl_class'=>'w50'),
	'sql'                     => "varchar(32) NOT NULL default ''"
);

class tl_module_containermodule extends Backend{
	public function __construct(){
		parent::__construct();
		$this->import('BackendUser', 'User');
	}

	public function getContainerTemplates(){
		return $this->getTemplateGroup('modulcontainer_');
	public function getModules(){
		$arrModules = array() ;
		$objModules = $this->Database->execute("SELECT m.id, m.name, t.name AS theme FROM tl_module m LEFT JOIN tl_theme t ON m.pid=t.id ORDER BY t.name, m.name") ;
		while ($objModules->next()){
			$arrModules[$objModules->theme][$objModules->id] = $objModules->name . ' (ID ' . $objModules->id . ')' ;
		}
		return $arrModules;
	}
}
