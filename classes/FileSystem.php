<?php
namespace cyclonephp\cfs;

use DI\ContainerBuilder;

interface FileSystem {
	
	public function getFilePath($relativePath);
	
	public function listFilePaths($relativePath);
	
	/**
	 * @return \DI\ContainerBuilder
	 */
	public function getDefaultDIContainer($configRelPath = 'config.php');
	
	public function configureDIContainer(ContainerBuilder $containerBuilder, $configRelPath = 'config.php');
	
}
