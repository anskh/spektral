<?php

declare(strict_types=1);

use App\Helper\Service;
use App\Model\Db\StatusPermintaanModel;
use Corephp\Http\Auth\UserPrincipalInterface;
use Corephp\Http\Renderer\ViewRenderer;
use Corephp\Http\Session\FlashMessage;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\Response\RedirectResponse;
use Psr\Http\Message\ResponseInterface;

if (!function_exists('view')) {
    /**
     * view
     *
     * @param  mixed $view
     * @param  mixed $params
     * @param  mixed $response
     * @param  mixed $template
     * @return ResponseInterface
     */
    function view(string $content, array $params, ResponseInterface $response, string $template = 'template'): ResponseInterface
    {
        $renderer = make(ViewRenderer::class, ['args' => [config('path.view')]]);
        $renderer->setParam('content', $content);
        $response->getBody()->write($renderer->render('template' . DS . $template, $params));

        return $response;
    }
}
if (!function_exists('render')) {
    /**
     * render
     *
     * @param  mixed $view
     * @param  mixed $params
     * @param  mixed $response
     * @return ResponseInterface
     */
    function render(string $view, array $params, ResponseInterface $response): ResponseInterface
    {
        $renderer = make(ViewRenderer::class, ['args' => [config('path.view')]]);
        $response->getBody()->write($renderer->render($view, $params));

        return $response;
    }
}
if (!function_exists('render_json')) {
    /**
     * render_json
     *
     * @param  mixed $data
     * @return ResponseInterface
     */
    function render_json($data): ResponseInterface
    {
        $response = new JsonResponse($data);

        return $response;
    }
}
if (!function_exists('redirect_to')) {
    /**
     * redirect_to
     *
     * @param  mixed $name
     * @param  mixed $param
     * @return ResponseInterface
     */
    function redirect_to(string $name, string $param = ''): ResponseInterface
    {

        return redirect_url(route($name, $param));
    }
}
if (!function_exists('redirect_url')) {
    /**
     * redirect_url
     *
     * @param  mixed $url
     * @return ResponseInterface
     */
    function redirect_url(string $url): ResponseInterface
    {

        return new RedirectResponse($url);
    }
}
if (!function_exists('auth')) {
    /**
     * auth
     *
     * @return UserPrincipalInterface
     */
    function auth(): UserPrincipalInterface
    {

        return Service::user();
    }
}
if (!function_exists('sweet_alert')) {

    /**
     * sweet_alert
     *
     * @param  mixed $flash
     * @return string
     */
    function sweet_alert(FlashMessage $flash): string
    {
        $type =  $flash->getType() === FlashMessage::ERROR ? 'error' : $flash->getType();

        return sprintf('Swal.fire({title: "%s",text: "%s",icon: "%s"});', strtoupper($type), $flash->firstMessage(), $type);
    }
}
if (!function_exists('rfc822_date')) {
    /**
     * get RFC 822 Date
     *
     * @return string
     */
    function rfc822_date(): string
    {
        $timezone = date('Z');
        $operator = ($timezone[0] === '-') ? '-' : '+';
        $timezone = abs(intval($timezone));
        $timezone = floor($timezone / 3600) * 100 + ($timezone % 3600) / 60;

        return sprintf('%s %s%04d', date('D, j M Y H:i:s'), $operator, $timezone);
    }
}
if(!function_exists('ticket_readonly')){    
    /**
     * ticket_readonly
     *
     * @param  mixed $id
     * @return bool
     */
    function ticket_readonly($id): bool
    {
        return $id == StatusPermintaanModel::STATUS_APPROVED || $id == StatusPermintaanModel::STATUS_CLOSED;
    }
}
if(!function_exists('status_permintaan'))
{    
    /**
     * status_permintaan
     *
     * @param  mixed $id
     * @param  mixed $label
     * @return string
     */
    function status_permintaan($id, string $label): string
    {
        if ($id == StatusPermintaanModel::STATUS_OPEN) { 
            return '<span class="badge bg-info">'. $label.'</span>';
        } elseif ($id == StatusPermintaanModel::STATUS_IN_PROGRESS) { 
            return '<span class="badge bg-warning">'. $label.'</span>';
        } elseif ($id == StatusPermintaanModel::STATUS_AWAITING_REPLY) { 
            return '<span class="badge bg-danger">'. $label.'</span>';
        } elseif ($id == StatusPermintaanModel::STATUS_APPROVED) { 
            return '<span class="badge bg-success">'. $label.'</span>';
        }else {
            return '<span class="badge bg-secondary">'. $label.'</span>';
        }
    }
}