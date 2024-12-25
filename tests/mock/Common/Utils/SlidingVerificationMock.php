<?php
namespace Sdk\Common\Utils;

use Marmot\Interfaces\CacheLayer;

class SlidingVerificationMock extends SlidingVerification
{
    public function getCacheLayer() : CacheLayer
    {
        return parent::getCacheLayer();
    }

    public function getCoverDataPublic() : array
    {
        return $this->getCoverData();
    }

    public function getBackgroundDataPublic() : array
    {
        return $this->getBackgroundData();
    }

    public function createSliderDiagramPublic(int $width, int $height)
    {
        return $this->createSliderDiagram($width, $height);
    }

    public function getTargetCoordinateDataPublic(
        int $backgroundWidth,
        int $backgroundHeight,
        int $coverWidth,
        int $coverHeight
    ) : array {
        return $this->getTargetCoordinateData($backgroundWidth, $backgroundHeight, $coverWidth, $coverHeight);
    }

    public function getBackgroundBase64Public($background) : string
    {
        return $this->getBackgroundBase64($background);
    }

    public function getSliderDiagramBase64Public($sliderDiagram) : string
    {
        return $this->getSliderDiagramBase64($sliderDiagram);
    }

    public function generateCacheWidthPublic(string $width, string $type) : bool
    {
        return $this->generateCacheWidth($width, $type);
    }

    public function verificationWidthPublic(string $width, string $type) : bool
    {
        return $this->verificationWidth($width, $type);
    }

    public function verificationSlidingTimePublic(string $slidingTime) : bool
    {
        return $this->verificationSlidingTime($slidingTime);
    }

    public function verificationYAxisCoordinateValuesPublic(array $yAxisCoordinateValues) : bool
    {
        return $this->verificationYAxisCoordinateValues($yAxisCoordinateValues);
    }
}
