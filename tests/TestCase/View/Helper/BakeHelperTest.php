<?php
/**
 * Tests for the overriden BakeHelper class.
 */
namespace LoadsysTheme\Test\TestCase\View\Helper;

use Bake\View\BakeView;
use LoadsysTheme\View\Helper\BakeHelper;
use Cake\Network\Request;
use Cake\TestSuite\Stub\Response;
use Cake\TestSuite\TestCase;

/**
 * \LoadsysTheme\Test\TestCase\View\Helper\BakeHelperTest
 */
class BakeHelperTest extends TestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = [];

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$request = new Request();
		$response = new Response();
		$this->View = new BakeView($request, $response);
		$this->BakeHelper = new BakeHelper($this->View);
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->View);
		unset($this->BakeHelper);

		parent::tearDown();
	}

	/**
	 * test stringifyList defaults
	 *
	 * @return void
	 */
	public function testStringifyListDefaults() {
		$list = ['one' => 'foo', 'two' => 'bar', 'three'];
		$result = $this->BakeHelper->stringifyList($list);
		$spaces = "\t";
		$expected = "\n" .
			$spaces . $spaces . "'one' => 'foo',\n" .
			$spaces . $spaces . "'two' => 'bar',\n" .
			$spaces . $spaces . "'three',\n" .
			$spaces;
		$this->assertSame($expected, $result);
	}
}
