<?php
/**
 * André Cristen - andrecristenibirama@gmail.com
 * Gerente de projeto & Desenvolvedor
 */

namespace App\Model\Utils;


class CacheControl
{
    protected $cacheVersion = '?v=20-06-2019-01';

    /**
     * @return string
     */
    public function getCacheVersion()
    {
        return $this->cacheVersion;
    }

    /**
     * @param string $cacheVersion
     */
    public function setCacheVersion($cacheVersion)
    {
        $this->cacheVersion = $cacheVersion;
    }


}