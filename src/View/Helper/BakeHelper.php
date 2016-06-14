<?php
/**
 * Extends the default BakeHelper. Modifies its defaults a bit to serve our
 * purposes.
 */
namespace LoadsysTheme\View\Helper;

use Bake\View\Helper\BakeHelper as BaseBakeHelper;

/**
 * LoadsysTheme\View\Helper\BakeHelper
 */
class BakeHelper extends BaseBakeHelper {
	/**
	 * Returns an array converted into a formatted multiline string
	 *
	 * This version uses tabs by default, and includes a trailing comma (on
	 * multi-line arrays only) by default.
	 *
	 * @param array $list array of items to be stringified
	 * @param array $options options to use
	 * @return string
	 */
	public function stringifyList(array $list, array $options = []) {
		$options += [
			'indent' => 2,
			'tab' => "\t",
		];

		// MUST be layered in a second pass to pick up the layered [indent]
		// value from the first pass!
		$options += [
			'trailingComma' => ($options['indent'] !== false),
		];

		return parent::stringifyList($list, $options);
	}
}
