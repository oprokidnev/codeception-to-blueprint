<?php declare(strict_types=1);

namespace Oprokidnev\CodeceptToBlueprint\Codeception;


use Doctrine\Common\Util\Inflector;

class ExtensionConfig
{
    protected $outputDir;

    /**
     * ExtensionConfig constructor.
     *
     * @param $outputDirectory
     */
    public function __construct($config)
    {
        foreach ($config as $name => $value){
            if(\property_exists(static::class, $propertyName = Inflector::camelize($name))){
                $this->{$propertyName} = $value;
            }
        }
    }

    /**
     * @return mixed
     */
    public function getOutputDir()
    {
        return $this->outputDir;
    }

}