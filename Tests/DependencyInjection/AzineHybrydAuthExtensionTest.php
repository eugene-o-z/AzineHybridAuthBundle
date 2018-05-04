<?php
namespace Azine\HybridAuthBundle\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Yaml\Parser;
use Azine\HybridAuthBundle\DependencyInjection\AzineHybridAuthExtension;
use Symfony\Component\Config\Definition\Processor;

class AzineHybrydAuthExtensionTest extends TestCase
{

//    private $errors;
//
//    protected function setUp() {
//        $this->errors = array();
//        set_error_handler(array($this, "errorHandler"));
//    }
//
//    public function errorHandler($errno, $errstr, $errfile, $errline, $errcontext) {
//        $this->errors[] = compact("errno", "errstr", "errfile",
//            "errline", "errcontext");
//    }
//
//    public function assertError($errstr, $errno) {
//        foreach ($this->errors as $error) {
//            if ($error["errstr"] === $errstr
//                && $error["errno"] === $errno) {
//                return;
//            }
//        }
//        $this->fail("Error with level " . $errno .
//            " and message '" . $errstr . "' not found in ",
//            var_export($this->errors, TRUE));
//    }
//
//    public function testOfAssiningDeprecatedParameter() {
//
//        $loader = new AzineHybridAuthExtension();
//        $config = $this->getConfig();
//        $loader->load(array($config), new ContainerBuilder());

//        $this->assertError("The option keys.key is deprecated you should use option keys.id to avoid error",
//            E_USER_DEPRECATED);
//    }
//
//    protected function getConfig(){
//
//        $yaml = <<<EOF
//azine_hybrid_auth:
//    providers:
//        LinkedIn:
//            enabled: true
//            scope: "r_basicprofile r_emailaddress"
//            keys:
//                key: 'linkedin_api_key'
//                secret: 'linkedin_api_secret'
//EOF;
//        $parser = new Parser();
//
//        return $parser->parse($yaml);
//    }

    /**
     * @group legacy
     * @expectedDeprecation The option keys.key is deprecated you should use option keys.id to avoid error
     */
    public function testOfAssiningDeprecatedParameter()
    {

        $this->processYamlConfiguration();
    }

    private function processYamlConfiguration()
    {
        $yaml = <<<EOF
azine_hybrid_auth:        
    providers:
        LinkedIn:
            enabled: true
            scope: "r_basicprofile r_emailaddress"
            keys:
                key: 'linkedin_api_key'
                secret: 'linkedin_api_secret'    
EOF;
        $parser = new Parser();

        return $this->processYaml($parser->parse($yaml));
    }

    private function processYaml($parsedYaml)
    {
        $processor = new Processor();
        $configDefinition = new Configuration();

        return $processor->processConfiguration($configDefinition, array($parsedYaml));
    }
}