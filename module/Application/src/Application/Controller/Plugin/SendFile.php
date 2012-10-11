<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class SendFile extends AbstractPlugin
{
    public function __invoke($newFileName, $originalFilePath)
    {
        if (!file_exists($originalFilePath) || !is_file($originalFilePath)) {
            throw new \RuntimeException('A system error occurred. We apologize for any inconvenience.');
        }

        $response = new \Zend\Http\PhpEnvironment\Response();
        $response->getHeaders()
                 ->addHeaders(array(
                    'Content-Type' => 'application/octet-stream',
                    'Content-Length' => filesize($originalFilePath),
                    'Content-Disposition' => 'attachment; filename='.$newFileName,
        ));
        $response->setContent(file_get_contents($originalFilePath));
        return $response->send();
    }
}
