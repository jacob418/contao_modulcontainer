<?php

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'Contao\ModuleContainerModule' => 'system/modules/modulcontainer/modules/ModuleContainerModule.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_containermodule' => 'system/modules/modulcontainer/templates',
	'container_default'   => 'system/modules/modulcontainer/templates',
	'container_f-topbar'   => 'system/modules/modulcontainer/templates',
));
