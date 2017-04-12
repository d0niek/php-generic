<?php

namespace d0niek\Generic\Service;

use Composer\Autoload\ClassLoader;
use d0niek\Generic\Model\GenericCollection;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class CollectionWriter implements CollectionWriterInterface
{
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
    }

    /**
     * @inheritDoc
     */
    public function write(GenericCollection $genericCollection, string $renderedCollecion): bool
    {
        $path = $this->getPathToNamespace($genericCollection->getNamespace() . '\\');
        $fileName = $path . $genericCollection->getClass() . '.php';

        $result = file_put_contents($fileName, $renderedCollecion);

        return $result !== false;
    }

    /**
     * @param string $namespace
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    private function getPathToNamespace(string $namespace): string
    {
        $path = $this->getPathFromPrefix($this->classLoader->getPrefixesPsr4(), $namespace);
        if ($path !== '') {
            return $path;
        }

        $path = $this->getPathFromPrefix($this->classLoader->getPrefixes(), $namespace);
        if ($path !== '') {
            return $path;
        }

        throw new \InvalidArgumentException('Could not determine path to namespace "' . $namespace . '"');
    }

    /**
     * @param array $prefixes
     * @param string $namespace
     *
     * @return string
     */
    private function getPathFromPrefix(array $prefixes, string $namespace): string
    {
        foreach ($prefixes as $composerNamespace => $path) {
            $strpos = strpos($namespace, $composerNamespace);
            if ($strpos !== false) {
                $extendPath = $this->extendComposerPath($path[0], $namespace, $composerNamespace);
                return $extendPath;
            }
        }

        return '';
    }

    /**
     * @param string $path
     * @param string $namespace
     * @param string $composerNamespace
     *
     * @return string
     * @throws /InvalidArgumentException
     */
    private function extendComposerPath(string $path, string $namespace, string $composerNamespace): string
    {
        if (strlen($namespace) === strlen($composerNamespace)) {
            return $path . '/';
        }

        $extendNamespace = str_replace($composerNamespace, '', $namespace);
        $extendPath = $path . '/' . str_replace('\\', '/', $extendNamespace);

        if (!file_exists($extendPath)) {
            throw new \InvalidArgumentException(
                'Path for namespace "' . $namespace . '" does not exists.' . "\n" .
                $extendPath
            );
        }

        return $extendPath;
    }
}
