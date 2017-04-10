<?php

namespace d0niek\GenericCollection\Generator;

use Composer\Autoload\ClassLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
abstract class GeneratorCommand extends Command
{
    /**
     * @var string[]
     */
    protected $primitiveType = ['bool', 'int', 'float', 'string', 'array'];

    /**
     * @var \Composer\Autoload\ClassLoader
     */
    private $classLoader;

    /**
     * @param \Composer\Autoload\ClassLoader $classLoader
     */
    public function __construct(ClassLoader $classLoader)
    {
        $this->classLoader = $classLoader;
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function executeParent(InputInterface $input, OutputInterface $output, string $collectionType): int
    {
        $data = [
            'type' => $input->getArgument('type'),
            'class' => $input->getArgument('type'),
            'namespace' => $input->getArgument('namespace')
        ];

        if (!in_array($data['type'], $this->primitiveType)) {
            $classInfo = $this->getClassInfo($data['class']);
            $data = array_merge($data, $classInfo);
        }

        return $this->generateCollection($data, $collectionType);
    }

    /**
     * @param string[] $data
     * @param string $collectionType
     *
     * @return bool
     */
    protected function generateCollection(array $data, string $collectionType): bool
    {
        $data['class'] = ucfirst($data['class']);
        extract($data);

        ob_start();
        include(__DIR__ . '/../../template/' . $collectionType . 'GenericCollection.php');
        $genericCollection = "<?php\n" . ob_get_clean();

        $path = $this->getPathToNamespace($data['namespace'] . '\\');
        $fileName = $path . $collectionType . $data['class'] . '.php';
        $result = file_put_contents($fileName, $genericCollection);

        echo 'New generic collection ', $collectionType, '<', $data['type'], "> saved in:\n";
        echo $fileName, "\n";

        return $result !== false;
    }

    /**
     * @param string $namespace
     *
     * @return string
     */
    private function getPathToNamespace(string $namespace): string
    {
        $path = $this->getPathFromPrefixes($this->classLoader->getPrefixesPsr4(), $namespace);
        if ($path !== '') {
            return $path;
        }

        $path = $this->getPathFromPrefixes($this->classLoader->getPrefixes(), $namespace);
        if ($path !== '') {
            return $path;
        }

        throw new \Exception("Dupa");
    }

    /**
     * @param array $prefixes
     * @param string $namespace
     *
     * @return string
     */
    private function getPathFromPrefixes(array $prefixes, string $namespace): string
    {
        foreach ($prefixes as $composerNamespace => $path) {
            $strpos = strpos($namespace, $composerNamespace);
            if ($strpos !== false) {
                $extendPath = $this->extendPath($namespace, $composerNamespace, $path[0]);
                return $extendPath;
            }
        }

        return '';
    }

    /**
     * @param string $namespace
     * @param string $composerNamespace
     * @param string $path
     *
     * @return string
     */
    private function extendPath(string $namespace, string $composerNamespace, string $path): string
    {
        if (strlen($namespace) === strlen($composerNamespace)) {
            return $path;
        }

        $extendNamespace = str_replace($composerNamespace, '', $namespace);
        $extendPath = $path . '/' . str_replace('\\', '/', $extendNamespace);

        if (!file_exists($extendPath)) {
            throw new \Exception(
                "Path for namespace '$namespace' does not exists.\n" .
                $extendPath
            );
        }

        return $extendPath;
    }

    /**
     * @param string $classFullName
     *
     * @return string[]
     */
    protected function getClassInfo(string $classFullName): array
    {
        if (!class_exists($classFullName)) {
            echo 'Warning! Class "', $classFullName, '" does not exists.', "\n";
        }

        $classInfo = ['type' => '', 'class' => '', 'use' => ''];

        $classNameSeparatorPos = strrpos($classFullName, '\\');
        if ($classNameSeparatorPos === false) {
            $classInfo['type'] = '\\' . $classFullName;
            $classInfo['class'] = $classFullName;
            return $classInfo;
        }

        $classInfo['type'] = substr($classFullName, $classNameSeparatorPos + 1);
        $classInfo['class'] = $classInfo['type'];
        $classInfo['use'] = substr($classFullName, 0, $classNameSeparatorPos);
        if ($classInfo['use'] === '') {
            $classInfo['type'] = '\\' . $classInfo['type'];
        }

        return $classInfo;
    }

    /**
     * @param string $type
     *
     * @return string
     */
    protected function getTypeCheckStatement(string $type): string
    {
        switch ($type) {
            case 'bool':
                return 'is_bool($value)';

            case 'int':
            case 'float':
                return 'is_numeric($value)';

            case 'string':
                return 'is_string($value)';

            case 'array':
                return 'is_array($value)';

            default:
                return '$value instanceof ' . $type;
        }
    }
}
