<?php

defined('SYSPATH') or die('No direct access allowed.');
/**
 * system controller.
 *
 * @package pnp4nagios
 * @author  Joerg Linge
 * @license GPL
 */
class System_Controller extends Template_Controller
{
    public $data = '';

    public $config = '';

    public $rrdtool = '';

    public $auth = '';

    public $start = '';

    public $end = '';

    public $theme = '';

    public $view = '';

    public $host = '';

    public $service = '';

    public $source = '';

    public $version = '';

    public $tpl = '';

    public $controller = '';

    public $session = '';

    public $url = '';


    public function __construct()
    {
        parent::__construct();

        $this->data    = new Data_Model();
        $this->config  = new Config_Model();
        $this->rrdtool = new Rrdtool_Model();
        $this->auth    = new Auth_Model();
    // $this->system    = new System_Model();
        $this->config->read_config();
        Kohana::config_set('locale.language', $this->config->conf['lang']);
        // Check for mod_rewrite
        $this->check_mod_rewrite();

        $this->start      = $this->input->get('start', false);
        $this->end        = $this->input->get('end', false);
        $this->theme      = pnp::clean($this->input->get('theme', false));
        $this->view       = pnp::clean($this->input->get('view', ''));
        $this->host       = pnp::clean($this->input->get('host', null));
        $this->service    = pnp::clean($this->input->get('srv', null));
        $this->source     = intval(pnp::clean($this->input->get('source', null)));
        $this->version    = pnp::clean($this->input->get('version', null));
        $this->tpl        = pnp::clean($this->input->get('tpl'));
        $this->controller = Router::$controller;

        $this->data->getTimeRange($this->start, $this->end, $this->view);
        if (! in_array(Router::$controller, ['image', 'image_special', 'xport'])) {
            $this->session = Session::instance();

            // Initialize CSRF Token
            $this->session->set('csrf_token', Security::token());

            // Session withou theme info
            if ($this->session->get('theme', 'new') == 'new') {
                if ($this->theme) {
                    // store $this->theme if available
                    Kohana::config_set('core.theme', $this->theme);
                    $this->session->set('theme', $this->theme);
                } else {
                    // set $this->theme to default value
                    $this->theme = $this->config->conf['ui-theme'];
                    Kohana::config_set('core.theme', $this->theme);
                }
            // Sesion with theme info
            } else {
                if ($this->theme && $this->theme != 'default') {
                    // store $this->theme if available
                    $this->session->set('theme', $this->theme);
                    Kohana::config_set('core.theme', $this->theme);
                } elseif ($this->theme == 'default') {
                    // reset to default theme
                    $this->theme = $this->config->conf['ui-theme'];
                    $this->session->set('theme', $this->theme);
                    Kohana::config_set('core.theme', $this->theme);
                } else {
                    // set $this->theme with session infos
                    $this->theme = $this->session->get('theme');
                    Kohana::config_set('core.theme', $this->theme);
                }
            }//end if

            if ($this->start && $this->end) {
                if ($this->session->get('timerange-reset', 0) == 0) {
                    $this->session->set('start', $this->start);
                    $this->session->set('end', $this->end);
                } else {
                    $this->session->set('timerange-reset', 0);
                }
            }
            if ($this->start && !$this->end) {
                if ($this->session->get('timerange-reset', 0) == 0) {
                    $this->session->set('start', $this->start);
                    $this->session->set('end', '');
                } else {
                    $this->session->set('timerange-reset', 0);
                }
            }
            if ($this->end && !$this->start) {
                if ($this->session->get('timerange-reset', 0) == 0) {
                    $this->session->set('end', $this->end);
                    $this->session->set('start', '');
                } else {
                    $this->session->set('timerange-reset', 0);
                }
            }
        }//end if
    }//end __construct()


    public function __call($method, $arguments)
    {
        // Disable auto-rendering
        $this->auto_render = false;

        // By defining a __call method, all pages routed to this controller
        // that result in 404 errors will be handled by this method, instead of
        // being displayed as "Page Not Found" errors.
        echo $this->_("The requested page doesn't exist") . " ($method)";
    }//end __call()


    /**
     * Handle paths to current theme etc
     */
    public function add_view($view = false)
    {
        $view = trim($view);
        if (empty($view)) {
            return false;
        }
        if (!file_exists(APPPATH . '/views/' . $view . '.php')) {
            return false;
        }
        // return new View($this->theme_path.$view);
        return new View($view);
    }//end add_view()


    public function check_mod_rewrite()
    {
        if (!function_exists('apache_get_modules')) {
            // Add index.php to every URL while not running withn apache mod_php
            Kohana::config_set('core.index_page', 'index.php');
            return true;
        }
        if (!in_array('mod_rewrite', apache_get_modules())) {
            // Add index.php to every URL while mod_rewrite is not available
            Kohana::config_set('core.index_page', 'index.php');
        }
        if ($this->config->conf['use_url_rewriting'] == 0) {
            Kohana::config_set('core.index_page', 'index.php');
        }
    }//end check_mod_rewrite()


    public function isAuthorizedFor($auth)
    {
        $conf = $this->config->conf;
        if ($auth == 'service_links') {
                $users = explode(',', $conf['allowed_for_service_links']);
            if (in_array('EVERYONE', $users)) {
                    return 1;
            } elseif (in_array('NONE', $users)) {
                    return 0;
            } elseif (in_array($this->auth->REMOTE_USER, $users)) {
                    return 1;
            } else {
                    return 0;
            }
        }
        if ($auth == 'host_search') {
                $users = explode(',', $conf['allowed_for_host_search']);
            if (in_array('EVERYONE', $users)) {
                    return 1;
            } elseif (in_array('NONE', $users)) {
                    return 0;
            } elseif (in_array($this->auth->REMOTE_USER, $users)) {
                    return 1;
            } else {
                    return 0;
            }
        }
        if ($auth == 'host_overview') {
                $users = explode(',', $conf['allowed_for_host_overview']);
            if (in_array('EVERYONE', $users)) {
                    return 1;
            } elseif (in_array('NONE', $users)) {
                    return 0;
            } elseif (in_array($this->auth->REMOTE_USER, $users)) {
                    return 1;
            } else {
                    return 0;
            }
        }
        if ($auth == 'pages') {
                $users = explode(',', $conf['allowed_for_pages']);
            if (in_array('EVERYONE', $users)) {
                    return 1;
            } elseif (in_array('NONE', $users)) {
                    return 0;
            } elseif (in_array($this->auth->REMOTE_USER, $users)) {
                    return 1;
            } else {
                    return 0;
            }
        }
    }//end isAuthorizedFor()


    public function isMobileDevice()
    {
        if ($this->session->get('classic-ui', 0) == 1) {
             return false;
        }
        if (preg_match('/' . $this->config->conf['mobile_devices'] . '/', $_SERVER['HTTP_USER_AGENT'])) {
            return true;
        } else {
            return false;
        }
    }//end isMobileDevice()
}//end class
