<?php

class Canalweb_Conversaa_Model_System_Config_Source_Dropdown_Values
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => 'php',
                'label' => 'PHP',
            ),
            array(
                'value' => 'js',
                'label' => 'Javascript',
            ),
        );
    }
}