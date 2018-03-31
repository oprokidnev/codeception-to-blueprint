<?php declare(strict_types=1);

namespace Oprokidnev\CodeceptToBlueprint\Writer;

use Codeception\Step;
use Codeception\Test\Cest;
use Oprokidnev\CodeceptToBlueprint\Blueprint\Call;
use Oprokidnev\CodeceptToBlueprint\Codeception\ExtensionConfig;

class BlueprintWriter
{
    /**
     * @var ExtensionConfig
     */
    protected $extensionConfig = null;

    /**
     * BlueprintWriter constructor.
     *
     * @param ExtensionConfig $extensionConfig
     */
    public function __construct(ExtensionConfig $extensionConfig)
    {
        $this->extensionConfig = $extensionConfig;
    }


    /**
     * @param string $string
     *
     * @return string
     */
    private function underscore($string)
    {
        $string = preg_replace('/(?<=[a-z])([A-Z])/', '_$1', $string);

        return strtolower($string);
    }

    protected function fqcnToFilename($fqcn)
    {
        $ns = \preg_split('/\\\\/', $fqcn);
        $ns = \array_map(\Closure::fromCallable([$this, 'underscore']), $ns);

        return \str_replace(['/'], '_', \implode('_', $ns));
    }


    public function write(Cest $test, array $steps)
    {
        $filename = $this->extensionConfig->getOutputDir().'/'.$this->fqcnToFilename(
                \get_class($test->getTestClass())
            ).'.apib';


        $api = new Call($test->getFeature());

        dump($steps);

        /** @var Step $step */
        foreach ($steps as $step) {
            switch ($step->getAction()) {
                case 'sendGET':
                    $args = $step->getArguments();
                    $request = $request ?? new Call\Request($args[0], 'GET');

                    if (\count($args) > 1) {
                        foreach ($args[1] as $parameterName => $parameterValue) {
                            $request->addParameter(
                                new Call\Request\Parameter(false, $parameterName, $parameterValue, '')
                            );
                        }
                    }
                    $response = new Call\Response($step->response);

                    $api->setRequest($request);
                    $api->setResponse($response);

                    break;
                case 'seeResponseContainsJson':
                    if (isset($response)) {
                        $response->set($step->getArguments()[0]);
                    }
                    break;

                case 'seeResponseCodeIs':
                    if (isset($response)) {
                        $response->setStatus($step->getArguments()[0]);
                    }
                    break;
                case 'seeResponseMatchesJsonType':
                    if (isset($response)) {
                        $response->setSchema(\json_encode($step->getArguments()[0]));
                    }
                    break;
            }
        }


        dump($api);
    }

    protected $test = <<<EPT

### Get promotions departments [GET /app.php/api/pricebook/promotions/departments{?account}]

+ Parameters

    + account (required, number, `88`) ... account id

+ Request (application/json)

+ Response 200 (application/json)

        {
            "data": [
            {
              "id": "1",
              "name": "01|Qwickserve",
              "disabled": false,
            },
            {
              "id": "2",
              "name": "02|Drinks",
              "disabled": true
            }
          ],
          "status": true,
          "success": true,
          "total": "2",
          "message": false
        }

EPT;


}