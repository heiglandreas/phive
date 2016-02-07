<?php
namespace PharIo\Phive;

/**
 * @covers PharIo\Phive\ExactVersionConstraint
 */
class ExactVersionConstraintTest extends \PHPUnit_Framework_TestCase {

    public static function compliantVersionProvider() {
        return [
            ['1.0.2', new Version('1.0.2')],
            ['4.8.9', new Version('4.8.9')],
            ['4.8', new Version('4.8')],
        ];
    }

    public static function nonCompliantVersionProvider() {
        return [
            ['1.0.2', new Version('1.0.3')],
            ['4.8.9', new Version('4.7.9')],
            ['4.8', new Version('4.8.5')],
        ];
    }

    /**
     * @dataProvider compliantVersionProvider
     *
     * @param string  $constraintValue
     * @param Version $version
     */
    public function testReturnsTrueForCompliantVersion($constraintValue, Version $version) {
        $constraint = new ExactVersionConstraint($constraintValue);
        $this->assertTrue($constraint->complies($version));
    }

    /**
     * @dataProvider nonCompliantVersionProvider
     *
     * @param string  $constraintValue
     * @param Version $version
     */
    public function testReturnsFalseForNonCompliantVersion($constraintValue, Version $version) {
        $constraint = new ExactVersionConstraint($constraintValue);
        $this->assertFalse($constraint->complies($version));
    }

}


