<?php
namespace EdpMarkdown;

class Module extends \Zend\View\Helper\AbstractHelper
{
    const MARKDOWN_NORMAL = 'normal';
    const MARKDOWN_EXTRA = 'extra';
    
    protected $classWhitelist = array(
        self::MARKDOWN_NORMAL => '\Michelf\Markdown',
        self::MARKDOWN_EXTRA => '\Michelf\MarkdownExtra'
    );
    
    protected static $defaultType = self::MARKDOWN_NORMAL;
    
    public function getViewHelperConfig()
    {
        return array('services' => array('markdown' => $this));
    }

    public function __invoke($string = null, $type = null)
    {
        if (null == $type) {
            $type = self::$defaultType;
        }
        
        $className = $this->classWhitelist[$type];
        if (!class_exists($className)) {
            $fileName = str_replace('\\', '/', $className) . '.inc.php';
            require_once __DIR__ . '/vendor/php-markdown' . $fileName;
        }
        return $className::defaultTransform($string);
    }
    
    public static function setDefaultType($type)
    {
        self::$defaultType = $type;
    }
}
