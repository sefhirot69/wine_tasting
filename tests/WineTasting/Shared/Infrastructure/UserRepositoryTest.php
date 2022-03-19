<?php

namespace App\Tests\WineTasting\Shared\Infrastructure;

use App\Entity\UserDoctrine;
use App\Repository\DoctrineUserRepository;
use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\Shared\Infrastructure\UserRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class UserRepositoryTest extends TestCase
{
    private DoctrineUserRepository|MockObject $doctrineRepositoryMock;

    protected function setUp(): void
    {
        $this->doctrineRepositoryMock = $this->createMock(DoctrineUserRepository::class);
    }

    /**
     * @test
     */
    public function shouldFindUserByEmail(): void
    {
        // GIVEN
        $email = new EmailValueObject('test@test.es');
        $this->doctrineRepositoryMock
            ->expects(self::once())
            ->method('findOneBy')
            ->willReturn(UserDoctrine::create('test@test.es', [], 'passFake', 1));

        // WHEN
        $userRepository = new UserRepository($this->doctrineRepositoryMock);
        $userDto = $userRepository->findUserByEmail($email);

        // THEN
        self::assertInstanceOf(UserDto::class, $userDto);
        self::assertContains('ROLE_USER', $userDto->getRoles());
        self::assertObjectHasAttribute('password', $userDto);
        self::assertObjectHasAttribute('id', $userDto);
        self::assertObjectHasAttribute('email', $userDto);
    }

    /**
     * @test
     */
    public function shouldReturnNullWhenNotFindUserByEmail(): void
    {
        $email = new EmailValueObject('test@test.es');
        $this->doctrineRepositoryMock
            ->expects(self::once())
            ->method('findOneBy')
            ->willReturn(null);

        // WHEN
        $userRepository = new UserRepository($this->doctrineRepositoryMock);
        $userDto = $userRepository->findUserByEmail($email);

        // THEN
        self::assertNull($userDto);
    }
}
