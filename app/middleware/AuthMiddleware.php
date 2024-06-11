<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Model\Db\UserModel;
use Corephp\Http\Auth\AuthProvider;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Corephp\Http\Auth\UserIdentity;
use Corephp\Http\Auth\UserPrincipal;
use Corephp\Http\Auth\UserPrincipalInterface;
use Corephp\Http\Session\Session;

/**
 * AuthMiddleware
 * -----------
 * AuthMiddleware
 *
 * @author Khaerul Anas <anasikova@gmail.com>
 * @since v1.0.0
 * @package App\Middleware
 */
class AuthMiddleware implements MiddlewareInterface
{
    private Session $session;
    private string $sessionAttribute;
    private string $userAttribute;
    
    /**
     * __construct
     *
     * @param  mixed $sessionAttribute
     * @param  mixed $userAttribute
     * @return void
     */
    public function __construct(string $sessionAttribute = '__session', string $userAttribute = '__user')
    {
        $this->sessionAttribute = $sessionAttribute;
        $this->userAttribute = $userAttribute;
    }
    
    /**
     * process
     *
     * @param  mixed $request
     * @param  mixed $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->session = $request->getAttribute($this->sessionAttribute);
        $userId = $this->session->getUserId();
        $userHash = $this->session->getUserHash();
        $userAgent = $request->getServerParams()['HTTP_USER_AGENT'];
        $user = $this->validateUser($userAgent, $userId, $userHash);
        $request = $request->withAttribute($this->userAttribute, $user);

        return $handler->handle($request);
    }
    
    /**
     * validateUser
     *
     * @param  mixed $userAgent
     * @param  mixed $userId
     * @param  mixed $userHash
     * @return UserPrincipalInterface
     */
    public function validateUser(string $userAgent, string $userId = null, ?string $userHash = null): UserPrincipalInterface
    {
        $provider = new AuthProvider(route('login'), route('logout'));
        if ($userId !== null && $userHash !== null) {
            $user = UserModel::row('*',['id='=> $userId, 'is_active=' => 1, 'AND']);
            if ($user) {
                $hash = sha1($user['email'] . $userAgent);
                if ($hash === $userHash) {
                    $roles = explode(',', $user['role']);
                    if ($roles) {          
                        $permissions = [];
                        foreach ($roles as $role){
                            $permissions = array_merge($permissions, config('permission.' . $role));
                        }
                        unset($user['password']);
                        $user['is_internal'] = str_ends_with($user['email'], '@bps.go.id') ? true: false;
                        return new UserPrincipal($provider, new UserIdentity($userId, $roles, $permissions, $user));
                    }
                }
            }
            $this->session->unsetUserId();
            $this->session->unsetUserHash();
        }

        return new UserPrincipal($provider);
    }
}
