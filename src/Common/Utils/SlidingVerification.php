<?php
namespace Sdk\Common\Utils;

use Marmot\Core;
use Marmot\Framework\Query\DataCacheQuery;

use Sdk\Common\Utils\Cache\SlidingVerificationCache;

class SlidingVerification extends DataCacheQuery
{
    const SLIDING_VERIFICATION_CACHE_ID = 'slidingVerification';
    const EXPIRATION_TIME = 600;
    const SLIDING_VERIFICATION_IMAGE_PATH = '/var/www/html/public/attachment/slidingImage/';
    const SLIDER_MODEL_IMAGE = 'sliderModel.png';
    const BACK_GROUND_IMAGES = array(
            'bg_1.png',
            'bg_2.png',
            'bg_3.png',
            'bg_4.png',
            'bg_5.png',
            'bg_6.png',
            'bg_7.png',
            'bg_8.png'
        );
    const RANGE_OFFSET = 10;
    const IMAGE_COLORAT_BLACK = 0; //某像素的颜色索引值-0为黑色
    const SLIDING_TIME_MAX = 10000; //ms
    const SLIDING_TIME_MIN = 50; //ms
    const WIDTH_OFFSET_MAX = 3;
    const WIDTH_OFFSET_MIN = -3;
    const VARIANCE_ERROR_VALUE = 0;
    const TYPE = array('login', 'register');

    public function __construct()
    {
        parent::__construct(new SlidingVerificationCache());
    }

    public function generateSlidingVerificationData(string $type = '')
    {
        ob_start();
        
        //获取遮盖层信息
        list($cover, $coverWidth, $coverHeight) = $this->getCoverData();
        //获取背景图信息
        list($background, $backgroundWidth, $backgroundHeight) = $this->getBackgroundData();
        //创建一个和遮盖层同样大小的图片
        $sliderDiagram = $this->createSliderDiagram($coverWidth, $coverHeight);

        //获取目标坐标数据
        list(
            $targetTopLeftCornerWidth,
            $targetTopLeftCornerHeight,
            $targetMaxWidth,
            $targetMaxHeight
        ) = $this->getTargetCoordinateData($backgroundWidth, $backgroundHeight, $coverWidth, $coverHeight);

        //根据目标坐标数据生成背景图及滑块图
        for ($i=$targetTopLeftCornerWidth; $i < $targetMaxWidth; $i++) {
            for ($j=$targetTopLeftCornerHeight; $j < $targetMaxHeight; $j++) {
                $width = $i-$targetTopLeftCornerWidth;
                $height = $j-$targetTopLeftCornerHeight;
                //取得某像素的颜色索引值。
                //获得背景图某像素的颜色索引值
                $backgroundColor = imagecolorat($background, $i, $j);
                $coverColor = imagecolorat($cover, $width, $height);
                //为图像分配颜色和透明度
                $targetCoordinateColor = imagecolorallocatealpha($background, 0, 0, 0, 60);
                //判断索引值区分具体的遮盖区域
                if ($coverColor == self::IMAGE_COLORAT_BLACK) {
                    //在指定的坐标处绘制一个像素
                    imagesetpixel($sliderDiagram, $width, $height, $backgroundColor);
                    imagesetpixel($background, $i, $j, $targetCoordinateColor);
                }
            }
        }

        //获取背景图base64码
        $backgroundBase64 = $this->getBackgroundBase64($background);
        //获取滑块图base64码
        $sliderDiagramBase64 = $this->getSliderDiagramBase64($sliderDiagram);

        $this->generateCacheWidth($targetTopLeftCornerWidth, $type);
        ob_end_clean();
        return [$backgroundBase64, $sliderDiagramBase64, $targetTopLeftCornerWidth, $targetTopLeftCornerHeight];
    }

    //获取遮盖层信息
    protected function getCoverData() : array
    {
        $sliderModelModelPath = self::SLIDING_VERIFICATION_IMAGE_PATH.self::SLIDER_MODEL_IMAGE;
        list($width, $height, $type, $attr) = getimagesize($sliderModelModelPath);
        //用于从PNG文件或URL创建新图像,成功时此函数返回图像资源标识符，错误时返回FALSE。
        $cover = imagecreatefrompng($sliderModelModelPath);

        unset($type);
        unset($attr);

        return [$cover, $width, $height];
    }

    //获取背景图信息
    protected function getBackgroundData() : array
    {
        $key = array_rand(self::BACK_GROUND_IMAGES);
        $image = self::BACK_GROUND_IMAGES[$key];
        $backgroundPath = self::SLIDING_VERIFICATION_IMAGE_PATH.$image;

        list($width, $height, $type, $attr) = getimagesize($backgroundPath);
        $background = imagecreatefrompng($backgroundPath);

        unset($type);
        unset($attr);

        return [$background, $width, $height];
    }

    //创建一个和遮盖层同样大小的图片
    protected function createSliderDiagram(int $width, int $height)
    {
        //创建画布
        $sliderDiagram = imagecreatetruecolor($width, $height);
        //用于设置在保存PNG图像时是否保留完整的Alpha通道信息,如果成功，则此函数返回TRUE；如果失败，则返回FALSE
        imagesavealpha($sliderDiagram, true);
        //为图像分配颜色和透明度
        //int imagecolorallocatealpha ( resource $image , int $red , int $green , int $blue , int $alpha )
        //$alpha:其值从 0 到 127。0 表示完全不透明，127 表示完全透明
        $bgColor = imagecolorallocatealpha($sliderDiagram, 255, 0, 0, 127);
        //用于用给定的颜色填充图像
        imagefill($sliderDiagram, 0, 0, $bgColor);

        return $sliderDiagram;
    }

    //获取目标数据
    protected function getTargetCoordinateData(
        int $backgroundWidth,
        int $backgroundHeight,
        int $coverWidth,
        int $coverHeight
    ) : array {
        $widthMax = $backgroundWidth-$coverWidth-self::RANGE_OFFSET;
        $heightMax = $backgroundHeight-$coverHeight-self::RANGE_OFFSET;

        $targetTopLeftCornerWidth = rand($coverWidth+self::RANGE_OFFSET, $widthMax);
        $targetTopLeftCornerHeight = rand(self::RANGE_OFFSET, $heightMax);

        $targetMaxWidth = $targetTopLeftCornerWidth + $coverWidth;
        $targetMaxHeight = $targetTopLeftCornerHeight + $coverHeight;

        return [$targetTopLeftCornerWidth, $targetTopLeftCornerHeight, $targetMaxWidth, $targetMaxHeight];
    }

    protected function getBackgroundBase64($background) : string
    {
        ob_clean();
        imagepng($background);
        $content = ob_get_contents();
        $backgroundBase64 = 'data:image/png;base64,' . base64_encode($content);
        imageDestroy($background);

        return $backgroundBase64;
    }

    protected function getSliderDiagramBase64($sliderDiagram) : string
    {
        ob_clean();
        imagepng($sliderDiagram);
        $content = ob_get_contents();
        $sliderDiagramBase64 = 'data:image/png;base64,' . base64_encode($content);
        imageDestroy($sliderDiagram);

        return $sliderDiagramBase64;
    }

    protected function generateCacheWidth(string $width, string $type) : bool
    {
        $cacheKey = self::SLIDING_VERIFICATION_CACHE_ID.$type;

        return $this->save($cacheKey, $width, self::EXPIRATION_TIME);
    }

    public function verification(string $width, string $type, string $slidingTime, array $yAxisCoordinateValues) : bool
    {
        return $this->verificationWidth($width, $type)
            && $this->verificationSlidingTime($slidingTime)
            && $this->verificationYAxisCoordinateValues($yAxisCoordinateValues);
    }

    protected function verificationWidth(string $width, string $type) : bool
    {
        $cacheKey = self::SLIDING_VERIFICATION_CACHE_ID.$type;
        $widthCache = $this->get($cacheKey);
        $offset = $widthCache-$width;

        if (empty($widthCache)
            || empty($width)
            || $offset > self::WIDTH_OFFSET_MAX
            || $offset < self::WIDTH_OFFSET_MIN
        ) {
            Core::setLastError(SLIDING_VERIFICATION_INCORRECT);
            return false;
        }

        return true;
    }

    protected function verificationSlidingTime(string $slidingTime) : bool
    {
        if ($slidingTime > self::SLIDING_TIME_MAX || $slidingTime < self::SLIDING_TIME_MIN) {
            Core::setLastError(SLIDING_VERIFICATION_INCORRECT);
            return false;
        }

        return true;
    }

    protected function verificationYAxisCoordinateValues(array $yAxisCoordinateValues) : bool
    {
        $variance = 0;

        $length = count($yAxisCoordinateValues);
        if (!empty($length)) {
            $average = array_sum($yAxisCoordinateValues)/$length;
            $count = 0;
            foreach ($yAxisCoordinateValues as $yAxisCoordinateValue) {
                $count += pow($average-$yAxisCoordinateValue, 2);
            }
            $variance = $count/$length;
        }

        if ($variance == self::VARIANCE_ERROR_VALUE) {
            Core::setLastError(SLIDING_VERIFICATION_INCORRECT);
            return false;
        }

        return true;
    }
}
