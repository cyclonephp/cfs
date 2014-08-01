<?php
namespace cyclonephp\cfs;

use DI\ContainerBuilder;

class FileSystemImplTest extends \PHPUnit_Framework_TestCase {
	
	private $me = 'FileSystemImplTest.php';
	
	public function testConstructor() {
		$subject = new FileSystemImpl(array(__DIR__));
	}
	
	public function testGetRootPaths() {
		$subject = $this->subject();
		$this->assertEquals(array(__DIR__), $subject->getRootPaths());
	}
	
	public function testGetFile() {
		$subject = $this->subject();
		$absPathOfMe = __DIR__ . DIRECTORY_SEPARATOR . $this->me;
		$this->assertEquals($absPathOfMe, $subject->getFilePath($this->me));
	}
	
	private function subject($rootDirs = array(__DIR__)) {
		return new FileSystemImpl($rootDirs);
	}
	
	/**
	 * 
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage file not found by relative path 'nonexistent'
	 */
	public function testGetFileFailure() {
		$subject = $this->subject();
		$subject->getFilePath('nonexistent');
	}
	
	public function testListFilePaths() {
		$subject = $this->subject();
		$this->assertEquals(array(__FILE__), $subject->listFilePaths($this->me));
	}
	
	public function testGetDefaultDIContainer() {
		$subject = $this->subject();
		$this->assertTrue($subject->getDefaultDIContainer() instanceof ContainerBuilder);
	}
	
}
