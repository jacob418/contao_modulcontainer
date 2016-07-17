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
							'options_callback'	=>	array('tl_content', 'getModules'),
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
	}
}
