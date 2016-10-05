<?php

/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'Contao\ModuleContainerModule' => 'system/modules/modulecontainer/modules/ModuleContainerModule.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'mod_containermodule' => 'system/modules/modulecontainer/templates',
	'container_default'   => 'system/modules/modulecontainer/templates'
));
