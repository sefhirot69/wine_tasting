<?php

namespace App\Tests\WineTasting\Signin\Infrastructure;

use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\User\Domain\Exceptions\EmailNotFoundException;
use App\WineTasting\User\Domain\UserDataSource;
use App\WineTasting\Signin\Domain\Dto\SignInUserDto;
use App\WineTasting\Signin\Domain\Dto\SingInByEmailDto;
use App\WineTasting\Signin\Domain\SignInEmailValueObject;
use App\WineTasting\Signin\Infrastructure\DoctrineSignInRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DoctrineSignInRepositoryTest extends TestCase
{
    private MockObject|UserDataSource $userDataSourceMock;

    protected function setUp(): void
    {
        $this->userDataSourceMock = $this->createMock(UserDataSource::class);
    }

    /**
     * @test
     */
    public function shouldAuthenticateByEmail(): void
    {
        // GIVEN
        $email = new SignInEmailValueObject('test@test.es');
        $this->userDataSourceMock
            ->expects(self::once())
            ->method('findUserByEmail')
            ->willReturn(UserDto::create(1, $email->getEmail(), [], '****'));
        $signInEmailDto = SingInByEmailDto::create($email);
        // WHEN

        $repository = new DoctrineSignInRepository($this->userDataSourceMock);
        $result = $repository->authenticateByEmail($signInEmailDto);

        // THEN
        self::assertInstanceOf(SignInUserDto::class, $result);
        self::assertObjectHasAttribute('password', $result);
        self::assertObjectHasAttribute('email', $result);
    }

    /**
     * @test
     */
    public function shouldExpectedEmailNotFound(): void
    {
        // THEN
        $this->expectException(EmailNotFoundException::class);

        // GIVEN
        $email = new SignInEmailValueObject('test@test.es');
        $this->userDataSourceMock
            ->expects(self::once())
            ->method('findUserByEmail')
            ->willReturn(null);
        $signInEmailDto = SingInByEmailDto::create($email);
        // WHEN

        $repository = new DoctrineSignInRepository($this->userDataSourceMock);
        $repository->authenticateByEmail($signInEmailDto);
    }
}
