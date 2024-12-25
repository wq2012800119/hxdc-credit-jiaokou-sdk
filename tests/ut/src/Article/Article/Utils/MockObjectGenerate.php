<?php
namespace Sdk\Article\Article\Utils;

use Sdk\Article\Article\Model\Article;
use Sdk\Article\Category\Utils\MockObjectGenerate as CategoryMockObjectGenerate;

use Sdk\User\Staff\Utils\MockObjectGenerate as StaffMockObjectGenerate;
use Sdk\Organization\Organization\Utils\MockObjectGenerate as OrganizationMockObjectGenerate;

class MockObjectGenerate
{
    public static function generateArticle(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Article {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $article = new Article($id);
        $article->setId($id);

        //title
        self::generateTitle($article, $value, $faker);
        //source
        self::generateSource($article, $value, $faker);
        //parentCategory,category
        self::generateParentCategoryAndCategory($article, $value, $faker);
        $article->setPubDate($faker->unixTime());
        //description
        self::generateDescription($article, $value, $faker);
        //cover
        self::generateCover($article, $value, $faker);
        //attachments
        self::generateAttachments($article, $value, $faker);
        //content
        self::generateContent($article, $value, $faker);
        //isSlides
        self::generateIsSlides($article, $value, $faker);
        //isHomeSlides
        self::generateIsHomeSlides($article, $value, $faker);
        //slidesPicture
        self::generateSlidesPicture($article, $value, $faker);
        //organization
        self::generateOrganization($article, $value, $faker);
        //staff
        self::generateStaff($article, $value, $faker);
        //topStatus
        self::generateTopStatus($article, $value, $faker);
        //status
        self::generateStatus($article, $value, $faker);
        //examineStatus
        self::generateExamineStatus($article, $value, $faker);

        $article->setStatus(0);
        $article->setCreateTime($faker->unixTime());
        $article->setUpdateTime($faker->unixTime());
        $article->setStatusTime($faker->unixTime());

        return $article;
    }

    private static function generateTitle(Article $article, array $value, $faker) :void
    {
        //title
        $title = isset($value['title']) ? $value['title'] : $faker->word();
        $article->setTitle($title);
    }

    private static function generateSource(Article $article, array $value, $faker) :void
    {
        //source
        $source = isset($value['source']) ? $value['source'] : $faker->word();
        $article->setSource($source);
    }

    private static function generateParentCategoryAndCategory(Article $article, array $value, $faker) :void
    {
        //category
        $category = isset($value['category']) ?
                        $value['category'] :
                        CategoryMockObjectGenerate::generateCategory($faker->randomDigitNotNull());

        //parentCategory
        $parentCategory = isset($value['parentCategory']) ?
                        $value['parentCategory'] :
                        CategoryMockObjectGenerate::generateCategory($category->getParentCategoryId());

        $article->setCategory($category);
        $article->setParentCategory($parentCategory);
    }

    private static function generateDescription(Article $article, array $value, $faker) :void
    {
        //description
        $description = isset($value['description']) ? $value['description'] : $faker->word();
        $article->setDescription($description);
    }

    private static function generateCover(Article $article, array $value, $faker) :void
    {
        //cover
        $cover = isset($value['cover']) ? $value['cover'] : array($faker->word());
        $article->setCover($cover);
    }

    private static function generateAttachments(Article $article, array $value, $faker) :void
    {
        //attachments
        $attachments = isset($value['attachments']) ? $value['attachments'] : array($faker->word());
        $article->setAttachments($attachments);
    }

    private static function generateContent(Article $article, array $value, $faker) :void
    {
        //content
        $content = isset($value['content']) ? $value['content'] : array($faker->word());
        $article->setContent($content);
    }

    private static function generateIsSlides(Article $article, array $value, $faker) : void
    {
        $isSlides = isset($value['isSlides']) ?
            $value['isSlides'] :
            $faker->randomElement(
                Article::IS_SLIDES
            );
        $article->setIsSlides($isSlides);
    }

    private static function generateIsHomeSlides(Article $article, array $value, $faker) : void
    {
        $isHomeSlides = isset($value['isHomeSlides']) ?
            $value['isHomeSlides'] :
            $faker->randomElement(
                Article::IS_HOME_SLIDES
            );
        $article->setIsHomeSlides($isHomeSlides);
    }
    
    private static function generateSlidesPicture(Article $article, array $value, $faker) :void
    {
        //slidesPicture
        $slidesPicture = isset($value['slidesPicture']) ? $value['slidesPicture'] : array($faker->word());
        $article->setSlidesPicture($slidesPicture);
    }

    private static function generateOrganization(Article $article, array $value, $faker) :void
    {
        //organization
        $organization = isset($value['organization']) ?
                        $value['organization'] :
                        OrganizationMockObjectGenerate::generateOrganization($faker->randomDigitNotNull());

        $article->setOrganization($organization);
    }

    private static function generateStaff(Article $article, array $value, $faker) :void
    {
        //staff
        $staff = isset($value['staff']) ?
                        $value['staff'] :
                        StaffMockObjectGenerate::generateStaff($faker->randomDigitNotNull());

        $article->setStaff($staff);
    }
    
    private static function generateTopStatus(Article $article, array $value, $faker) : void
    {
        $topStatus = isset($value['topStatus']) ?
            $value['topStatus'] :
            $faker->randomElement(
                Article::TOP_STATUS
            );
        $article->setTopStatus($topStatus);
    }
    
    private static function generateStatus(Article $article, array $value, $faker) : void
    {
        $status = isset($value['status']) ?
            $value['status'] :
            $faker->randomElement(
                Article::STATUS
            );
        $article->setStatus($status);
    }
    
    private static function generateExamineStatus(Article $article, array $value, $faker) : void
    {
        $examineStatus = isset($value['examineStatus']) ?
            $value['examineStatus'] :
            $faker->randomElement(
                Article::EXAMINE_STATUS
            );
        $article->setExamineStatus($examineStatus);
    }
}
