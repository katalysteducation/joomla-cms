<?php
/**
 * @version     3.0.0
 * @package     Joomla.Site
 * @subpackage  mod_finder
 *
 * @copyright   Copyright (C) Katalyst Education 2015. Wszystkie prawa zastrzeżone.
 * @license     GNU General Public License v2 lub późniejsza; zobacz LICENSE.txt
 * @author      Tomasz Stach <tomasz.stach@katalysteducation.org> - http://katalysteducation.org
 */

namespace Joomla\Module\Finder\Site\Module;

defined('_JEXEC') || die;

\JLoader::import('twig.library');

use Phproberto\Joomla\Twig\Module\BaseTwigModule;

/**
 * Finder module.
 *
 * @since  3.0.0
 */
class FinderModule extends BaseTwigModule
{
    /**
     * Module created by module
     *
     * @var  string
     */
    protected $data;

    /**
     * Method to set data from module.
     *
     * @param   array  $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * Load layout data.
     *
     * @return  array
     */
    protected function loadLayoutData(): array
    {
        return [
            'cssClass' => $this->getCssClass(),
            'cssId' => $this->getCssId(),
            'moduleInstance' => $this,
            'params' => $this->getParams(),
            'data' => $this->data,
        ];
    }
}
