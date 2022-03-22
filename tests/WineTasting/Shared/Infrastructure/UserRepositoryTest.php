<?php

namespace App\Tests\WineTasting\Shared\Infrastructure;

use App\Repository\DoctrineUserRepository;
use App\Tests\Factory\UserDoctrineFactory;
use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\User\Infrastructure\UserRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Zenstruck\Foundry\Test\Factories;

final class UserRepositoryTest extends TestCase
{
    use Factories;
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
        $user = UserDoctrineFactory::createOne()->object();
        $email = new EmailValueObject('test@test.es');
        $this->doctrineRepositoryMock
            ->expects(self::once())
            ->method('findOneBy')
            ->willReturn($user);

        // WHEN
        $userRepository = new UserRepository($this->doctrineRepositoryMock);
        $userDto = $userRepository->findUserByEmail($email);

        // THEN
        self::assertInstanceOf(UserDto::class, $userDto);
        self::assertSame($userDto->getId(), $user->getId());
        self::assertSame($userDto->getRoles(), $user->getRoles());
        self::assertSame($userDto->getPassword(), $user->getPassword());
        self::assertSame($userDto->getEmail(), $user->getEmail());
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
