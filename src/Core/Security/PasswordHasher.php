<?php
/**
 * MIT License
 *
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

namespace Apex\Core\Security;

use ParagonIE\ConstantTime\Base64;

class PasswordHasher implements PasswordHasherInterface
{
    /**
     * Construct a new password hasher.
     *
     * @param string|int|null $algo    A password algorithm constant denoting the algorithm to use when hashing the password.
     * @param array           $options An associative array containing options.
     *
     * @return void Returns nothing.
     */
    public function __construct(public readonly string|int|null $algo, private $options = [])
    {
        //
    }

    /**
     * Compute a new hash.
     *
     * @param string $password The user's password.
     *
     * @return string Returns the hashed password.
     */
    public function compute(string $password): string
    {
        return password_hash(Base64::encode(hash('sha384', $password, true)), $this->algo, $this->options);
    }

    /**
     * Verifies that a password matches a hash
     *
     * @param string $password The user's password.
     * @param string $hash     A hash created by password_hash().
     *
     * @return bool Returns true if the password and hash match, or false otherwise.
     */
    public function verify(string $password, string $hash): bool
    {
        return password_verify(Base64::encode(hash('sha384', $password, true)), $hash);
    }

    /**
     * Checks if the given hash matches the given options.
     *
     * @param string $hash A hash created by password_hash().
     *
     * @return bool Returns true if the hash should be rehashed to match the given algo and options, or false otherwise.
     */
    public function needsRehash(string $hash): bool
    {
        return password_needs_rehash($hash, $this->algo, $this->options);
    }
}
