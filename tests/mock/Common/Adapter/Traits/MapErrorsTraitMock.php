<?php
namespace Sdk\Common\Adapter\Traits;

class MapErrorsTraitMock
{
    use MapErrorsTrait;

    public function getAlonePossessMapErrors() : array
    {
        return array();
    }

    public function getMapErrorsPublic() : array
    {
        return $this->getMapErrors();
    }

    public function commonMapErrorsPublic() : array
    {
        return $this->commonMapErrors();
    }

    public function mapErrorsPublic()
    {
        return $this->mapErrors();
    }

    public function singleMapErrorsPublic()
    {
        return $this->singleMapErrors();
    }

    public function multipleMapErrorsPublic()
    {
        return $this->multipleMapErrors();
    }

    public function isSingleErrorsPublic() : bool
    {
        return $this->isSingleErrors();
    }
}
