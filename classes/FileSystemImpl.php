<?php
namespace cyclonephp\cfs;

use DI\ContainerBuilder;

class FileSystemImpl implements FileSystem {
	
	private $rootPaths;
	
	public function __construct($rootPaths) {
		$this->rootPaths = array();
		foreach ($rootPaths as $rootPath) {
			$this->rootPaths []= rtrim($rootPath, DIRECTORY_SEPARATOR);
		}
	}
	
	public function getFilePath($relativePath) {
		foreach ($this->rootPaths as $rootPath) {
			$candidate = $this->candidate($rootPath, $relativePath);
			if (file_exists($candidate)) {
				return $candidate;
			}
		}
		throw new \InvalidArgumentException("file not found by relative path '{$relativePath}'");
	}
	
	private function candidate($rootPath, $relativePath) {
		return $rootPath . DIRECTORY_SEPARATOR . $relativePath;
	}
	
	public function listFilePaths($relativePath) {
		$rval = array();
		foreach ($this->rootPaths as $rootPath) {
			$candidate = $this->candidate($rootPath, $relativePath);
			if (file_exists($candidate)) {
				$rval []= $candidate;
			}
		}
		return $rval;
	}
	
	public function getDefaultDIContainer($configRelPath = 'config.php') {
		$rval = new ContainerBuilder;
		$this->configureDIContainer($rval);
		return $rval;
	}
	
	public function configureDIContainer(ContainerBuilder $containerBuilder, $configRelPath = 'config.php') {
		foreach ($this->listFilePaths($configRelPath) as $absConfigPath) {
			$containerBuilder->addDefinitions($absConfigPath);
		}
	}
	
	public function getRootPaths() {
		return $this->rootPaths;
	}
	
}
