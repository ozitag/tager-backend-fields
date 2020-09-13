<?php

namespace OZiTAG\Tager\Backend\Fields\Fields;

use OZiTAG\Tager\Backend\Fields\Base\Field;
use OZiTAG\Tager\Backend\Fields\Enums\FieldType;
use OZiTAG\Tager\Backend\Fields\Types\GalleryType;

class GalleryField extends Field
{
    public function __construct($label, $scenario = null, $withCaptions = false)
    {
        parent::__construct($label, FieldType::Gallery);

        $this->setMetaParam('scenario', $scenario);

        $this->setMetaParam('withCaptions', (boolean)$withCaptions);
    }

    /**
     * @return GalleryType
     */
    public function getTypeInstance()
    {
        /** @var GalleryType $type */
        $type = parent::getTypeInstance();
        $type->setHasCaptions($this->getMetaParamValue('withCaptions', false));
        return $type;
    }
}
