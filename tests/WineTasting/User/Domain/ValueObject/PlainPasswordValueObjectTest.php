<?php

namespace App\Tests\WineTasting\User\Domain\ValueObject;

use App\WineTasting\Shared\Domain\Exceptions\InvalidLengthPasswordException;
use App\WineTasting\Shared\Domain\Exceptions\InvalidPasswordFormatException;
use App\WineTasting\Shared\Domain\ValueObjects\PasswordValueObject;
use App\WineTasting\User\Domain\ValueObject\PlainPasswordValueObject;
use PHPUnit\Framework\TestCase;

class PlainPasswordValueObjectTest extends TestCase
{
    /**
     * @dataProvider passwordInvalidFormatProviders
     * @test
     */
    public function shouldExpectedInvalidPasswordFormat($password): void
    {
        $this->expectException(InvalidPasswordFormatException::class);
        new PlainPasswordValueObject($password);
    }

    public function passwordInvalidFormatProviders(): array
    {
        return [
            ['aa^bac'],
            ['121@/23'],
            ['=12a123!'],
            ['12Ñw*3'],
            ['********'],
        ];
    }

    /**
     * @dataProvider passwordInvalidLengthPasswordProviders
     * @test
     */
    public function shouldExpectedInvalidLengthPassword($password): void
    {
        $this->expectException(InvalidLengthPasswordException::class);
        new PlainPasswordValueObject($password);
    }

    public function passwordInvalidLengthPasswordProviders(): array
    {
        return [
            ['a'],
            ['1234'],
            ['a1w34r567ui'],
            ['1p'],
            ['1233123132123'],
        ];
    }
}
