<?php
class Canalweb_Conversaa_Model_Observer
{
    public function addJavascriptBlock($observer)
    {
        $controller = $observer->getAction();
        $layout = $controller->getLayout();
        $conversaa_url = Mage::getStoreConfig('conversaa/main/conversaa_url',Mage::app()->getStore());
        if(!empty($conversaa_url)){
            $scriptjs = '
            <script type="text/javascript">
                // Create var with our value from back-office settings (needed in js/conversaa.js)
                conversaaUrl = "' . $conversaa_url . '"
            </script>
            ';
            $block = $layout->createBlock('core/text');
            $block->setText($scriptjs);
            $layout->getBlock('head')->append($block);
        }
    }
}
