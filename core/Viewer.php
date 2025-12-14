<?php

namespace Core;

use RuntimeException;

class Viewer
{

    public static function render(string $template, array $data, string $layout = null): string
    {
        $content = static::renderTemplate($template, $data);
        return static::renderLayout($layout, $data, $content);
    }

    private static function renderTemplate(string $template, array $data)
    {

        extract($data);

        $path = "../app/Views/$template.php";
        if (!file_exists($path)) {
            throw new RuntimeException("Error: Viewer Does Not Exists => $path ");
        }

        ob_start();
        require $path;
        return ob_get_clean();
    }

    private static function renderLayout(?string $template, array $data, string $content)
    {
        if ($template === null) {
            return $content;
        }

        extract([...$data, 'content' => $content]);
        $path = "../app/Views/$template.php";

        if (!file_exists($path)) {
            return throw new RuntimeException("Error File Does Not Exists : $path");
        }

        ob_start();
        require $path;
        return ob_get_clean();
    }
}
