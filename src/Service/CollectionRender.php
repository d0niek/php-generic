<?php

namespace d0niek\GenericCollection\Service;

/**
 * @author Damian Glinkowski <damianglinkowski@gmail.com>
 */
class CollectionRender implements CollectionRenderInterface
{
    /**
     * @var string
     */
    private $rootPath;

    /**
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }

    /**
     * @inheritDoc
     */
    public function render(array $parameters, string $collectionType): string
    {
        $template = $this->rootPath . '/template/' . $collectionType . 'Generic.php';
        if (!file_exists($template)) {
            throw new \InvalidArgumentException(
                'Wrong collection type. Could not find template for ' . $collectionType
            );
        }

        extract($parameters);

        ob_start();
        include($template);
        $genericCollection = "<?php\n" . ob_get_clean();

        return $genericCollection;
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
