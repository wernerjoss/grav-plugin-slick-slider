<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class SlicksliderPlugin
 * @package Grav\Plugin
 */
class SlicksliderPlugin extends Plugin
{
    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'onPluginsInitialized' => [
                // Uncomment following line when plugin requires Grav < 1.7
                // ['autoload', 100000],
                ['onPluginsInitialized', 0]
            ]
        ];
    }

    /**
     * Composer autoload
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized(): void
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        // Enable the main events we are interested in
        $this->enable([
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigTemplatePaths' => ['onTwigTemplatePaths', 0],
            'onPageInitialized' => ['onPageInitialized', 0]
        ]);
    }

    public function onPageInitialized(Event $event)
    {
        /** @var Page */
        $page = $event['page'];

        $this->addAssets();
    }
    
    private function addAssets()
    {
        /** @var Assets */
        $assets = $this->grav['assets'];
        $config = $this->config->get('plugins.slickslider');
        // $assets->addJs('https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['group' => 'bottom']);   // cdn
        // $assets->addCss('https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
        $assets->addJs('plugins://' . $this->name . '/assets/slick.min.js', ['group' => 'bottom']); // local
        $assets->addJs('plugins://' . $this->name . '/assets/slider.js', ['group' => 'bottom']);
        $assets->addCss('plugins://' . $this->name . '/assets/slick.css');
    }

    public function onTwigTemplatePaths()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    public function onShortcodeHandlers(Event $e)
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__ . '/shortcodes');
    }

}
