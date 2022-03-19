<?php

namespace App\Tests\WineTasting\User\Infrastructure;

use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\Shared\Domain\ValueObjects\PasswordValueObject;
use App\WineTasting\User\Domain\Dto\UserRegisterDto;
use App\WineTasting\User\Infrastructure\SymfonyUserHashPasswordRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SymfonyUserHashPasswordRepositoryTest extends TestCase
{
    /**
     * @var MockObject|UserPasswordHasherInterface
     */
    private MockObject|UserPasswordHasherInterface $userPassHasherMock;

    protected function setUp(): void
    {
        $this->userPassHasherMock = $this->createMock(UserPasswordHasherInterface::class);
    }


    /**
     * @test
     */
    public function shouldUserRegisterDtoWithHashPassword(): void
    {
        //GIVEN
        $passwordHashed = new PasswordValueObject('*******');
        $plainPassword = new PasswordValueObject('fake');
        $userRegisterDtoOriginal = UserRegisterDto::create(
            new EmailValueObject('fake@fake.es'),
            $plainPassword,
        );

        $this->userPassHasherMock
            ->expects(self::once())
            ->method('hashPassword')
            ->willReturn($passwordHashed->getPassword());

        //WHEN
        $repository = new SymfonyUserHashPasswordRepository($this->userPassHasherMock);
        $result = $repository->userWithHashPassword($userRegisterDtoOriginal);

        //THEN
        self::assertNotEquals($result->getPassword(), $userRegisterDtoOriginal->getPassword());
        self::assertNotSame($result, $userRegisterDtoOriginal);
    }
}
