#!/usr/bin/env php
<?php

use Samwilson\PhpFlickr\PhpFlickr;
use Stash\Driver\FileSystem;
use Stash\Pool as StashPool;

require_once __DIR__ . '/../vendor/autoload.php';

// Set up phpFlickr.
$config = require_once __DIR__ . '/../config.php';
$phpflickr = new PhpFlickr($config['consumer_key'], $config['consumer_secret']);
$driver = new FileSystem([ 'path' => __DIR__ . '/../cache' ]);
$pool = new StashPool($driver);
$phpflickr->setCache($pool);

// Get method info.
$methodsResponse = $phpflickr->reflection()->getMethods();
$methods = [];
foreach ($methodsResponse as $method) {
    $methodParts = explode('.', $method);
    $methodGroup = array_slice($methodParts, 1, count($methodParts) - 2);
    $methodGroupName = implode('', array_map('ucfirst', $methodGroup)) . 'Api';
    $classname = '\\Samwilson\\PhpFlickr\\' . $methodGroupName;
    $methods[$methodGroupName]['classname'] = $classname;
    $methods[$methodGroupName]['methods'][$method] = $methodParts[count($methodParts) - 1];
}

// Create PHP code.
foreach ($methods as $methodGroupName => $methodInfo) {
    $classname = basename(str_replace('\\', '/', $methodInfo['classname']));
    $php = "<?php\n\n"
        . "namespace Samwilson\PhpFlickr;\n\n"
        . "class " . $classname . " extends ApiMethodGroup\n{\n\n";
    foreach ($methodInfo['methods'] as $method => $shortMethod) {
        $details = $phpflickr->reflection()->getMethodInfo($method);
        $desc = wordwrap($details['method']['description'], 80, "\n     * ");
        $auth = $details['method']['needslogin'] ? 'requires' : 'does not require';
        $params = [];
        $sigs = [];
        $paramNames = [];
        foreach ($details['arguments']['argument'] as $arg) {
            if ($arg['name'] === 'api_key') {
                continue;
            }
            $nameParts = explode('_', $arg['name']);
            $phpName = $nameParts[0] . implode('', array_map('ucfirst', array_slice($nameParts, 1)));
            $paramDesc = str_replace("\n", ' ', $arg['_content']);
            $params[] = wordwrap('@param string $' . $phpName . ' ' . $paramDesc, 80, "\n     * ");
            $sigs[] = '$' . $phpName . (isset($arg['optional']) && $arg['optional'] ? ' = null' : '');
            $paramNames[$arg['name']] = "'" . $arg['name'] . "' => \$$phpName";
        }
        $url = 'https://www.flickr.com/services/api/' . $method . '.html';
        $methodPhp = "    /**\n     * $desc\n"
            . "     *\n"
            . "     * This method $auth authentication.\n"
            . "     *\n"
            . "     * @link $url\n"
            . "     * " . implode("\n     * ", $params) . "\n"
            . "     * @return\n"
            . "     */\n"
            . "    public function " . $shortMethod . "(" . implode(', ', $sigs) . ")\n    {\n";
        if (count($params) > 0) {
            $methodPhp .= "        \$params = [\n"
                . "            " . implode(",\n            ", $paramNames) . "\n"
                . "        ];\n"
                . "        return \$this->flickr->request('" . $method . "', \$params);\n";
        } else {
            $methodPhp .= "        return \$this->flickr->request('" . $method . "');\n";
        }
        $methodPhp .= "    }\n\n";
        try {
            $reflection = new ReflectionClass($methodInfo['classname']);
            $reflection->getMethod($shortMethod);
        } catch (ReflectionException $exception) {
            if ($shortMethod !== 'echo') {
                // Don't flag echo() as missing, as it's called "testEcho" in the code.
                echo "Not found: " . $methodInfo['classname'] . '::' . $shortMethod . "()\n\n$methodPhp";
            }
        }
        $php .= $methodPhp;
    }
    $php .= "}\n";

    $filename = __DIR__ . '/../src/' . $classname . '.php';
    echo "Writing $filename\n";
    file_put_contents($filename, $php);
}
