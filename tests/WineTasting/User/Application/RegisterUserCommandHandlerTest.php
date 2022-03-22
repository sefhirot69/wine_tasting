<?php

namespace App\Tests\WineTasting\User\Application;

use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\Shared\Domain\ValueObjects\PasswordValueObject;
use App\WineTasting\User\Application\RegisterUserCommand;
use App\WineTasting\User\Application\RegisterUserCommandHandler;
use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\User\Domain\Dto\UserRegisterDto;
use App\WineTasting\User\Domain\Exceptions\EmailExistsException;
use App\WineTasting\User\Domain\UserDataSource;
use App\WineTasting\User\Domain\UserHashPasswordDataSource;
use App\WineTasting\User\Domain\ValueObject\PlainPasswordValueObject;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RegisterUserCommandHandlerTest extends TestCase
{
    private MockObject|UserDataSource $userDataSourceMock;

    private MockObject|UserHashPasswordDataSource $userHashPasswordDataSource;

    protected function setUp(): void
    {
        $this->userDataSourceMock = $this->createMock(UserDataSource::class);
        $this->userHashPasswordDataSource = $this->createMock(UserHashPasswordDataSource::class);
    }

    /**
     * @test
     */
    public function shouldReturnUserDtoIfRegisterIsSuccessful(): void
    {
        // GIVEN
        $email = new EmailValueObject('test@test.es');
        $plainPassword = new PlainPasswordValueObject('passFake');
        $hashedPassword = new PasswordValueObject('56789');
        $command = RegisterUserCommand::create($email, $plainPassword);

        $this->userHashPasswordDataSource
            ->expects(self::once())
            ->method('userWithHashPassword')
            ->willReturn(UserRegisterDto::create($email, $hashedPassword));
        $this->userDataSourceMock
            ->expects(self::once())
            ->method('persist')
            ->willReturn(UserDto::create(1, $email, [], $hashedPassword));

        // WHEN
        $commandHandler = new RegisterUserCommandHandler(
            $this->userHashPasswordDataSource,
            $this->userDataSourceMock
        );
        $result = ($commandHandler)($command);

        // THEN
        self::assertInstanceOf(UserDto::class, $result);
        self::assertNotSame($result->getPassword(), $plainPassword);
    }

    /**
     * @test
     */
    public function shouldReturnAnExceptionEmailExist(): void
    {
        // THEN
        $this->expectException(EmailExistsException::class);

        $email = new EmailValueObject('test@test.es');
        $plainPassword = new PlainPasswordValueObject('passFake');
        $hashedPassword = new PasswordValueObject('*******');
        $command = RegisterUserCommand::create($email, $plainPassword);

        $this->userHashPasswordDataSource
            ->expects(self::never())
            ->method('userWithHashPassword')
            ->willReturn(UserRegisterDto::create($email, $hashedPassword));
        $this->userDataSourceMock
            ->expects(self::never())
            ->method('persist')
            ->willReturn(UserDto::create(1, $email, [], $hashedPassword));
        $this->userDataSourceMock
            ->method('findUserByEmail')
            ->willReturn(UserDto::create(2, $email, [], '******'));

        // WHEN
        $commandHandler = new RegisterUserCommandHandler(
            $this->userHashPasswordDataSource,
            $this->userDataSourceMock
        );
        ($commandHandler)($command);
    }
}
