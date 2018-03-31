<?php declare(strict_types=1);

namespace Oprokidnev\CodeceptToBlueprint\Codeception;

use Codeception\Event\FailEvent;
use Codeception\Event\PrintResultEvent;
use Codeception\Event\StepEvent;
use Codeception\Event\SuiteEvent;
use Codeception\Event\TestEvent;
use \Codeception\Events;
use Codeception\Test\Cest;
use Oprokidnev\CodeceptToBlueprint\Writer\BlueprintWriter;

class Extension extends \Codeception\Extension
{
    protected $outputDir = '';
    protected $extensionConfig = null;
    protected $writer = null;

    public static $events = array(
//        Events::SUITE_AFTER => 'afterSuite',
        Events::TEST_BEFORE => 'beforeTest',
        Events::STEP_AFTER  => 'afterStep',
        Events::SUITE_AFTER => 'afterSuite',
//        Events::TEST_FAIL          => 'testFailed',
//        Events::RESULT_PRINT_AFTER => 'print',
    );

    public function __construct($config, $options)
    {
        $config['output_dir'] = rtrim(\codecept_output_dir(), '/').'/'.ltrim(
                \array_key_exists('output_dir', $config) ? $config['output_dir'] : 'blueprint',
                '/'
            );

        $this->extensionConfig = new ExtensionConfig($config);

        parent::__construct($config, $options);
    }

    public function afterSuite(SuiteEvent $e)
    {
        if ($this->currentTest !== null) {
            $this->handleSteps($this->currentTest, $this->steps);
        }
    }

    protected $currentTest;

    protected $steps = [];

    public function beforeTest(TestEvent $e)
    {
        if ($e->getTest() instanceof Cest) {
            if ($e->getTest() !== $this->currentTest) {
                if ($this->currentTest !== null) {
                    $this->handleSteps($this->currentTest, $this->steps);
                }
                $this->steps = [];
            }
            $this->currentTest = $e->getTest();
        } else {
            $this->currentTest = null;
            $this->steps = [];
        }
    }

    protected function handleSteps($test, $steps)
    {
        return $this->getWriter()->write($test, $steps);
    }

    public function afterStep(StepEvent $e)
    {
        if ($this->currentTest) {
            if (\stristr($e->getStep()->getAction(), 'send')) {
                $e->getStep()->response = $this->getModule('REST')->grabResponse();
            }
            $this->steps[] = $e->getStep();
        }
    }

    public function getWriter()
    {
        if (!$this->writer) {
            $this->writer = new BlueprintWriter($this->extensionConfig);
        }

        return $this->writer;
    }

}