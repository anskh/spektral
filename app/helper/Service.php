<?php

declare(strict_types=1);

namespace App\Helper;

use Corephp\Helper\Service as BaseService;
use Corephp\Http\Auth\UserPrincipalInterface;

/**
 * Service
 * -----------
 * Class for helping access service component
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package App\Helper
 */
class Service extends BaseService
{      
    /**
     * user
     *
     * @param  mixed $userAttribute
     * @return UserPrincipalInterface
     */
    public static function user(string $userAttribute = '__user'): UserPrincipalInterface
    {
        return static::$request->getAttribute($userAttribute);
    }
}