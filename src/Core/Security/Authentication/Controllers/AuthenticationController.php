<?php
/**
 * Copyright (c) 2022 Nicholas English
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Apex\Core\Security\Authentication\Controllers;

use Apex\Core\Security\Exceptions\InvalidOperationException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AuthenticationController
{
    /**
     * Construct a new authentication controller.
     *
     * @throws \Apex\Core\Security\Exceptions\InvalidOperationException If there is an invalid call.
     *
     * @return void Returns nothing.
     */
    public function __construct()
    {
        if (!function_exists('apex')) {
            throw new InvalidOperationException('Invalid call to `\Apex\Core\Security\Authentication\Controllers\AuthenticationController`');
        }
    }

    /**
     * Show the login form.
     *
     * @param \Psr\Http\Message\RequestInterface $request The incoming HTTP request.
     *
     * @return Psr\Http\Message\ResponseInterface Returns the HTTP response.
     */
    public function loginShow(RequestInterface $request): ResponseInterface
    {
        return apex('templating')->render('authentication.login')
    }

    /**
     * Show the register form.
     *
     * @param \Psr\Http\Message\RequestInterface $request The incoming HTTP request.
     *
     * @return Psr\Http\Message\ResponseInterface Returns the HTTP response.
     */
    public function registerShow(RequestInterface $request): ResponseInterface
    {
        return apex('templating')->render('authentication.register')
    }

    /**
     * Show the forgot password form.
     *
     * @param \Psr\Http\Message\RequestInterface $request The incoming HTTP request.
     *
     * @return Psr\Http\Message\ResponseInterface Returns the HTTP response.
     */
    public function forgotShow(RequestInterface $request): ResponseInterface
    {
        return apex('templating')->render('authentication.forgot')
    }
}
