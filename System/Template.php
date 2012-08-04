<?php 

class Template {
    
    public static function getTemplate($className, $subTemplate = null) {
        $template = Config::getTemplatePath() . DIRECTORY_SEPARATOR . $className;
        if ($subTemplate) {
            $template .= DIRECTORY_SEPARATOR . $subTemplate;
        }
        $template .= '.tpl.php';
        
        if (!file_exists($template)) {
            throw new TemplateObject_Exception("No template available. " . $template);
        }
        
        return $template;
    }
}