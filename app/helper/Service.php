<?php

declare(strict_types=1);

namespace App\Helper;

use Corephp\Helper\Service as BaseService;
use Corephp\Http\Auth\UserPrincipalInterface;
use PHPMailer\PHPMailer\PHPMailer;

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
    /**
     * mailer
     *
     * @param  bool $enableException
     * @return PHPMailer
     */
    public static function mailer(bool $enableException = true): PHPMailer
    {
        $mailer             = new PHPMailer($enableException);
        $mailer->isSMTP();
        $mailer->Host       = config('smtp.host');
        $mailer->SMTPAuth   = true;
        $mailer->Username   = config('smtp.user');
        $mailer->Password   = config('smtp.pass');
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mailer->Port       = config('smtp.port');
        
        return $mailer;
    }
}