<?php

class Template {
    protected $viewPath;

    public function __construct($viewPath = '../app/views/') {
        $this->viewPath = $viewPath;
    }

    public function render($template, $data = []) {
        // Load the template file
        $content = file_get_contents($this->viewPath . $template . '.php');
        
        // Replace template tags with actual content
        $content = $this->parseTemplate($content);

        // Make $data available to the view
        extract($data);

        // Evaluate and return the final content
        ob_start();
        eval('?>' . $content);
        return ob_get_clean();
    }

    protected function parseTemplate($content) {
        // Match and replace template tags with corresponding views
        return preg_replace_callback('/{{\s*(\w+)\s*}}/', function ($matches) {
            $viewFile = $this->viewPath . 'partials/' . $matches[1] . '.php';
            if (file_exists($viewFile)) {
                return file_get_contents($viewFile);
            }
            throw new Exception("Partial file '$viewFile' not found.");
        }, $content);
    }
}

