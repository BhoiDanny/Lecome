<?php

namespace Http\Middleware;

use App\Http\Middleware\Role;
use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{

    public function test_if_role_passed_on_middleware_is_admin()
    {
        $role = 'admin';
        $request = $this->createMock('Illuminate\Http\Request');
        $request->expects($this->once())
            ->method('user')
            ->willReturn((object)['role' => 'admin']);

        //Act
        $roleMiddleware = new Role();
        $response = $roleMiddleware->handle($request, function () {}, $role);

        //Assert
        $this->assertNull($response);
    }

    public function test_if_role_passed_on_middleware_is_vendor()
    {
        $role = 'vendor';
        $request = $this->createMock('Illuminate\Http\Request');
        $request->expects($this->once())
            ->method('user')
            ->willReturn((object)['role' => 'vendor']);

        //Act
        $roleMiddleware = new Role();
        $response = $roleMiddleware->handle($request, function () {}, $role);

        //Assert
        $this->assertNull($response);
    }
}
