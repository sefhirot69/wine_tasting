<?php

namespace App\Tests\WineTasting\User\Application;

use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\Shared\Domain\ValueObjects\PasswordValueObject;
use App\WineTasting\User\Application\RegisterUserCommand;
use App\WineTasting\User\Application\RegisterUserCommandHandler;
use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\User\Domain\Dto\UserRegisterDto;
use App\WineTasting\User\Domain\UserDataSource;
use App\WineTasting\User\Domain\UserHashPasswordDataSource;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RegisterUserCommandHandlerTest extends TestCase
{
    /**
     * @var UserDataSource|MockObject
     */
    private MockObject|UserDataSource $userDataSourceMock;
    /**
     * @var UserHashPasswordDataSource|MockObject
     */
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
        //GIVEN
        $email = new EmailValueObject('test@test.es');
        $plainPassword = new PasswordValueObject('passFake');
        $hashedPassword = new PasswordValueObject('*****');
        $command = RegisterUserCommand::create($email, $plainPassword);

        $this->userHashPasswordDataSource
            ->expects(self::once())
            ->method('userWithHashPassword')
            ->willReturn(UserRegisterDto::create($email, $hashedPassword));
        $this->userDataSourceMock
            ->expects(self::once())
            ->method('persist')
            ->willReturn(UserDto::create(1, $email, [], $hashedPassword));

        //WHEN
        $commandHandler = new RegisterUserCommandHandler(
            $this->userHashPasswordDataSource,
            $this->userDataSourceMock
        );
        $result = ($commandHandler)($command);

        //THEN
        self::assertInstanceOf(UserDto::class, $result);
        self::assertNotSame($result->getPassword(), $plainPassword);
    }
}
