<?php


namespace Magenest\Movie\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use http\Env\Request;


class EnventSaveConfigTextField implements ObserverInterface
{
    private $request;

    /**
     * ConfigChange constructor.
     * @param RequestInterface $request
     * @param WriterInterface $configWriter
     */
    public function __construct(
        RequestInterface $request,
        WriterInterface $configWriter
    )
    {
        $this->request = $request;
        $this->configWriter = $configWriter;

    }

    public function execute(EventObserver $observer)
    {
        $content = $this->request->getParam('groups')['content']['fields']['text_field']['value'];
        if ($content == "Ping")
            $content = "Pong";
        $this->configWriter->save('config_mv/content/text_field', $content);

    }
}