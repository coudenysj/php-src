--TEST--
Bug #71851	SplObjectStorage incorrectly aliases offsetSet
--FILE--
<?php

class Test extends \SplObjectStorage
{
    /**
     * {@inheritDoc}
     */
    public function attach($object, $data = null)
    {
        throw new \RuntimeException('this is a test');
    }
}

$instance = new Test;
$object = new \stdClass;
$data = ['foo' => 'bar'];

try {
    $instance[$object] = $data; // should throw RuntimeException
catch (\RuntimeException $e) {
    echo $e->getMessage() . "(" . $e->getLine() .  ")\n";
}

--EXPECT--
this is a test(13)
