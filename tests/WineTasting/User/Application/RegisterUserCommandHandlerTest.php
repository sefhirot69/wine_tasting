<?php

namespace App\Tests\WineTasting\User\Application;

use App\WineTasting\Shared\Domain\ValueObjects\EmailValueObject;
use App\WineTasting\User\Application\RegisterUserCommand;
use App\WineTasting\User\Application\RegisterUserCommandHandler;
use App\WineTasting\User\Domain\Dto\UserDto;
use App\WineTasting\User\Domain\UserDataSource;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RegisterUserCommandHandlerTest extends TestCase
{
    /**
     * @var UserDataSource|MockObject
     */
    private MockObject|UserDataSource $userDataSourceMock;

    protected function setUp(): void
    {
        $this->userDataSourceMock = $this->createMock(UserDataSource::class);
    }


    /**
     * @test
     */
    public function shouldReturnTruIfRegisterIsSuccessful(): void
    {
        //GIVEN
        $email = new EmailValueObject('test@test.es');
        $password = 'passFake';
        $command = RegisterUserCommand::create($email, $password);
        $this->userDataSourceMock
            ->expects(self::once())
            ->method('persist')
            ->willReturn(true);

        //WHEN
        $commandHandler = new RegisterUserCommandHandler($this->userDataSourceMock);
        $result = ($commandHandler)($command);

        //THEN
        self::assertTrue($result);
    }
}
