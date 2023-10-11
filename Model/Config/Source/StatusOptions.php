<?php
namespace Chandan\Distributor\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class StatusOptions implements ArrayInterface
{
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                 'value' => $value,
                 'label' => $label,
             ];
        }

        return $result;
    }

    public function getOptions()
    {
        return [
            '1' => __('Active'),
            '0' => __('Inactive')
        ];
    }
}
