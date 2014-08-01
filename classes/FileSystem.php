<?php
namespace cyclonephp\cfs;

use DI\ContainerBuilder;

interface FileSystem {
	
	public function getFilePath($relativePath);
	
	public function listFilePaths($relativePath);
	
	/**
	 * @return \DI\ContainerBuilder
	 */
	public function getDefaultDIContainer();
	
	public function configureDIContainer(ContainerBuilder $containerBuilder);
	
}
