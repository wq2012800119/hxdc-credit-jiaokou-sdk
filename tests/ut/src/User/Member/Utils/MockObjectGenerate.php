<?php
namespace Sdk\User\Member\Utils;

use Sdk\User\Member\Model\Member;

class MockObjectGenerate
{
    public static function generateMember(
        int $id = 0,
        int $seed = 0,
        array $value = array()
    ) : Member {
        $faker = \Faker\Factory::create('zh_CN');
        $faker->seed($seed);

        $member = new Member($id);
        $member->setId($id);

        //subjectName
        self::generateSubjectName($member, $value, $faker);
        //cellphone
        self::generateCellphone($member, $value, $faker);
        //identification
        self::generateIdentification($member, $value, $faker);
        //idCard
        self::generateIdCard($member, $value, $faker);
        //password
        self::generatePassword($member, $value, $faker);
        //gender
        self::generateGender($member, $value, $faker);
        //email
        self::generateEmail($member, $value, $faker);
        //address
        self::generateAddress($member, $value, $faker);
        //question
        self::generateQuestion($member, $value, $faker);
        //answer
        self::generateAnswer($member, $value, $faker);
        //status
        self::generateStatus($member, $value, $faker);
        $member->setCreateTime($faker->unixTime());
        $member->setUpdateTime($faker->unixTime());
        $member->setStatusTime($faker->unixTime());

        return $member;
    }

    private static function generateSubjectName(Member $member, array $value, $faker) :void
    {
        //subjectName
        $subjectName = isset($value['subjectName']) ? $value['subjectName'] : $faker->name();
        $member->setSubjectName($subjectName);
    }

    private static function generateCellphone(Member $member, array $value, $faker) :void
    {
        //cellphone
        $cellphone = isset($value['cellphone']) ? $value['cellphone'] : $faker->phoneNumber();
        $member->setCellphone($cellphone);
    }

    private static function generateIdentification(Member $member, array $value, $faker) :void
    {
        //identification
        $identification = isset($value['identification']) ? $value['identification'] : $faker->name();
        $member->setIdentification($identification);
    }

    private static function generateIdCard(Member $member, array $value, $faker) :void
    {
        //idCard
        $idCard = isset($value['idCard']) ? $value['idCard'] : $faker->bothify('##################');
        $member->setIdCard($idCard);
    }

    private static function generatePassword(Member $member, array $value, $faker) :void
    {
        //password
        $password = isset($value['password']) ? $value['password'] : $faker->bothify('###??@A??');
        $member->setPassword($password);
    }

    private static function generateGender(Member $member, $value, $faker) : void
    {
        $gender = isset($value['gender']) ? $value['gender'] : $faker->randomElement(Member::GENDER);

        $member->setGender($gender);
    }

    private static function generateEmail(Member $member, array $value, $faker) :void
    {
        //email
        $email = isset($value['email']) ? $value['email'] : $faker->email();
        $member->setEmail($email);
    }

    private static function generateAddress(Member $member, array $value, $faker) :void
    {
        //address
        $address = isset($value['address']) ? $value['address'] : $faker->address();
        $member->setAddress($address);
    }

    private static function generateQuestion(Member $member, $value, $faker) : void
    {
        $question = isset($value['question']) ? $value['question'] : $faker->randomElement(Member::QUESTION);

        $member->setQuestion($question);
    }

    private static function generateAnswer(Member $member, array $value, $faker) :void
    {
        //answer
        $answer = isset($value['answer']) ? $value['answer'] : $faker->word();
        $member->setAnswer($answer);
    }

    private static function generateStatus(Member $member, $value, $faker) : void
    {
        $status = isset($value['status']) ? $value['status'] : $faker->randomElement(Member::STATUS);

        $member->setStatus($status);
    }
}
