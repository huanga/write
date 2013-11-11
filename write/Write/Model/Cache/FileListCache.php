<?php
namespace Write\Model\Cache;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use Write\Model\AbstractPhalconCache;

class FileListCache extends AbstractPhalconCache
{
    protected function _initialize()
    {
        $this->setListByNames();
    }

    /**
     * @return array
     */
    public function getListByNames()
    {
        return $this->_model;
    }

    /**
     * @param $listByNames
     *
     * @return FileListCache
     */
    public function setListByNames($listByNames = null)
    {
        // No need to load things if we already got a copy from cache
        if (!empty($this->_model) && ($listByNames === null)) {
            return $this;
        } else {
            if ($listByNames === null) {
                $path = DATADIR;
                $directory = new RecursiveDirectoryIterator($path);
                $iterator = new RecursiveIteratorIterator($directory);
                $files = new RegexIterator($iterator, '/^.+\.md$/i', \RecursiveRegexIterator::GET_MATCH);

                $listByNames = array();
                foreach ($files as $filename => $file) {
                    $listByNames[$filename] = filemtime($filename);
                }

                // Sort it by last edit time, newest first
                arsort($listByNames);
            }
        }
        $this->_model = $listByNames;

        return $this;
    }
}