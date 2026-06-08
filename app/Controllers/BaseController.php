<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */

    protected $user_login;
    protected $app;
    protected $pesan;
    protected $pesan_total;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        session();
        $this->user_login = new \App\Models\UserModel();
        $this->app        = new \App\Models\AplikasiModel();
        $this->app         = $this->app->first();
        $this->pesan      = new \App\Models\PesanModel();
        if (session()->has('id')) {
            $this->user_login  = $this->user_login->find(session()->get('id'));
            $this->pesan_total = $this->pesan->where('untuk_user_id', session()->get('id'))->where('status', '0')->countAllResults();
            $this->pesan       =
                $this->pesan
                ->select('pesan.*, user.username, user.id as user_id, user.foto')
                ->join('user', 'user.id = pesan.dari_user_id')
                ->where('untuk_user_id', session()->get('id'))
                ->find();
        }
    }
}
