<?php
class Canalweb_Conversaa_Model_Observer
{
    public function addJavascriptBlock($observer)
    {
        $controller = $observer->getAction();
        $layout = $controller->getLayout();
        $conversaa_url = Mage::getStoreConfig('conversaa/main/conversaa_url',Mage::app()->getStore());
        $conversaa_method =  Mage::getStoreConfig('conversaa/main/conversaa_method',Mage::app()->getStore());
        if(!empty($conversaa_url)){
            if($conversaa_method == 'js'){
                $content = '
                <script type="text/javascript">
                    // Create var with our value from back-office settings (needed in js/conversaa.js)
                    conversaaUrl = "' . $conversaa_url . '"
                </script>
                ';
            }elseif ($conversaa_method == 'php') {
                $headBlock = $this->getLayout()->getBlock('head');
                $title = ($headBlock)? $headBlock->getTitle() : '';
                $mail = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
                $d = urlencode(base64_encode(serialize(array(
                    'page_url'   => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],
                    'page_title' => $title,
                    'email' => $mail
                ))));

                $content = '<img src="http://'.$conversaa_url.'/mtracking.gif?d=' . $d . '" style="display: none;" />';
            }
            $block = $layout->createBlock('core/text');
            $block->setText($content);
            $layout->getBlock('head')->append($block);
        }
    }
}
