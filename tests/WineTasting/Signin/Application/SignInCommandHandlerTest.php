<?php

namespace App\Tests\WineTasting\Signin\Application;

use App\WineTasting\Signin\Application\SignInCommand;
use App\WineTasting\Signin\Application\SignInCommandHandler;
use PHPUnit\Framework\TestCase;

use PHPUnit\Framework\MockObject\MockObject;
use App\WineTasting\Signin\Domain\Dto\UserDto;
use App\WineTasting\Signin\Domain\SignInDataSource;
use App\WineTasting\Signin\Domain\SignInEmailValueObject;

final class SignInCommandHandlerTest extends TestCase
{
    private MockObject|SignInDataSource $signInDataSourceMock;

    protected function setUp(): void
    {

        $this->signInDataSourceMock = $this->createMock(SignInDataSource::class);
    }

    /**
     * @test
     * @return void
     */
    public function shouldReturnUserDto(): void
    {

        //GIVEN
        $command = SignInCommand::create(new SignInEmailValueObject('test@test.es'), 'fake');
        $userDto = UserDto::create(
            $command->getEmail(),
            'xxxxxxxx'
        );
        $this->signInDataSourceMock
            ->expects(self::once())
            ->method('authenticate')
            ->willReturn($userDto);

        //WHEN
        $commandHandler = new SignInCommandHandler($this->signInDataSourceMock);
        $result         = ($commandHandler)($command);

        //THEN
        self::assertInstanceOf(UserDto::class, $result);
        self::assertObjectHasAttribute('email', $result);
        self::assertObjectHasAttribute('password', $result);
    }

}
