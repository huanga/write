<?php
namespace Write\Controller;

use Ciconia\Ciconia;
use Ciconia\Extension\Gfm;
use Write\Exception\HTTP\NotFoundException;
use Write\Model\Cache\FileListCache;

class FrontController extends AbstractController
{

    protected function _getContent($path)
    {
        $mdPath = $path . '.md';
        $htmlPath = $path . '.html';

        // Verify that the markdown file still exist
        if (file_exists($mdPath)) {
            $pagebody = '';
            // Check if we already have HTML version
            if (file_exists($htmlPath)) {
                // If the HTML file is newer than the markdown file, we don't need to rebuild it
                if (filemtime($mdPath) < filemtime($htmlPath)) {
                    $pagebody = file_get_contents($htmlPath);
                }
            }

            if ($pagebody == '') {
                // TODO: Check if allPages cache needs to be rebuilt, and rebuild as necessary
                // Build the page
                $md = file_get_contents($mdPath);
                $pagebody = $this->_renderMarkdown($md);

                // Attempt to cache the file
                $handle = fopen($htmlPath, 'w');
                fwrite($handle, $pagebody);
            }

            return $pagebody;
        } else if (is_dir($path)) {
            // Directory for category
            $allPages = new FileListCache( $this->di, $path );

            $pagebody = '';
            $shown = 0;
            foreach ($allPages as $mdPath => $lastUpdated) {
                $localPath = substr($mdPath, 0, -3); // Remove .md
                $pagebody .= $this->_getContent($localPath);
                $shown++;

                if ($shown > 30) {
                    break;
                }
            }

            return $pagebody;
        } else {
            return null;
        }
    }

    protected function _renderMarkdown($md)
    {
        $ciconia = new Ciconia();
        $ciconia->addExtension(new Gfm\FencedCodeBlockExtension());
        $ciconia->addExtension(new Gfm\TaskListExtension());
        $ciconia->addExtension(new Gfm\InlineStyleExtension());
        $ciconia->addExtension(new Gfm\WhiteSpaceExtension());
        $ciconia->addExtension(new Gfm\TableExtension());

        $rendered = $ciconia->render($md);

        return $rendered;
    }

    public function getAction()
    {
        $params = $this->dispatcher->getParams();
        if (empty($params)) {
            $this->dispatcher->forward(
                array(
                    'controller' => 'front',
                    'action' => 'homepage'
                )
            );
            return false;
        }
        $path = DATADIR . implode('/', $params);
        $pagebody = $this->_getContent($path);

        if ($pagebody === null) {
            throw new NotFoundException( '404 Not found!' );
        }

        $this->view->pick('Front/get');
        $this->view->setVar('pagebody', $pagebody);
    }

    public function homepageAction()
    {
        $this->view->pick('Front/get');

        $allPages = new FileListCache($this->di);

        $pagebody = '';
        $shown = 0;
        foreach ($allPages as $mdPath => $lastUpdated) {
            $path = substr($mdPath, 0, -3); // Remove .md
            $pagebody .= $this->_getContent($path);
            $shown++;

            if ($shown > 30) {
                break;
            }
        }

        $this->view->setVar('pagebody', $pagebody);
    }
}
