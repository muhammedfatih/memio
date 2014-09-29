<?php

namespace test\Gnugat\Medio;

use Gnugat\Medio\Application;
use test\Gnugat\Medio\Helper\Input;

class EditionTestCase extends \PHPUnit_Framework_TestCase
{
    protected function runFor(Input $input)
    {
        $filename = $this->getFixture($input->fixtureName);

        $argv = array(
            'medio',
            $input->commandName,
            $input->fullyQualifiedClassname,
            $filename,
        );

        $application = new Application();
        $application->run(count($argv), $argv);

        $this->assertCorrectlyEdited($input->fixtureName);
    }

    /**
     * Prepares a new copy of fixture and returns its filename.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getFixture($name)
    {
        $before = __DIR__.'/before/'.$name.'.php';
        $after = __DIR__.'/after/'.$name.'.php';
        if (file_exists($after)) {
            unlink($after);
        }
        copy($before, $after);

        return $after;
    }

    /**
     * @param string $name
     */
    protected function assertCorrectlyEdited($name)
    {
        $afterFilename = __DIR__.'/after/'.$name.'.php';
        $expectedFilename = __DIR__.'/expected/'.$name.'.php';

        $after = file_get_contents($afterFilename);
        $expected = file_get_contents($expectedFilename);

        $this->assertSame($expected, $after, 'Failed to correctly edit '.$name);
    }
}
