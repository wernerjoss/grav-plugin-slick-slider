<?php
namespace Grav\Plugin\Shortcodes;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class SlickSliderShortcode extends Shortcode {
    public function init() {
        $this->shortcode->getHandlers()->add('slickslider', function(ShortcodeInterface $sc) {
            $s = $sc->getContent();
            $twig = $this->twig;
            $params = $sc->getParameters();
            $config = $this->config->get('plugins.slickslider');
            // TODO: imgFiles (Array) is Parameter from shortcode:
            if (isset($params['imgFiles'])) {
                $imgFiles = $this->grav['twig']->processString($params['imgFiles']);
            } else $imgFiles = '';
            /*
             */
            $output = $twig->processTemplate('partials/slickslider.html.twig',
                [
                    'imgFiles' => $imgFiles
                ]);
            return $output;
        });
    }
}
