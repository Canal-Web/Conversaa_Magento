<?php
class Canalweb_Conversaa_Model_Validation extends Mage_Core_Model_Config_Data
{
    public function save()
    {
        $url = $this->getValue(); // get value from b-o input

        if(strpos($url, 'http://') === false)
        {
          exit("Url format not valid");
        }
        elseif (substr($url, -1) == '/')
        {
          exit("The url must not end with a slash");
        }

        return parent::save(); // original save method
    }
}
