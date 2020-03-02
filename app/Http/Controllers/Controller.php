<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function onConstruct()
    {
        date_default_timezone_set('UTC');

        $this->response = new \Phalcon\Http\Response();
        $this->response->setStatusCode(200, 'OK');
        $this->response->setHeader('Content-Type', 'application/json');

        // library benchmark
        $this->bench = $this->di->get('bench');

        $this->bench->start('core');

        if (!empty($_REQUEST['store_id'])) {
            $_REQUEST['store_id'] = storeIdTrim($_REQUEST['store_id']);
        }

        if (!empty($_GET['store_id'])) {
            $_GET['store_id'] = storeIdTrim($_GET['store_id']);
        }

        $this->request = $this->di->get('request');
        $this->dater   = $this->di->get('dater');

        // http caching
        $this->input = $this->request->getQuery();

        // remove rewrite url
        if (isset($this->input['_url'])) {
            unset($this->input['_url']);
        }

        $this->config    = $this->di->get('config');
        $this->client    = $this->di->get('client');
        $this->ormcache  = $this->di->get('orm_cache');
        $this->httpcache = $this->di->get('http_cache')->setParam($this->input);
        $this->partial   = $this->di->get('partial_response');

        $this->format     = !empty($this->input['format']) ? $this->input['format'] : 'json';
        $this->page       = isset($this->input['page']) && $this->input['page'] != '' ? (int) $this->input['page'] : 1;
        $this->page       = ($this->page <= 0) ? 1 : $this->page;
        $this->limit      = isset($this->input['limit']) && $this->input['limit'] != '' ? (int) $this->input['limit'] : 20;
        $this->offset     = ($this->page - 1) * $this->limit;
        $this->order      = isset($this->input['order']) && $this->input['order'] != '' ? $this->input['order'] : false;
        $this->sort       = isset($this->input['sort']) && $this->input['sort'] != '' ? $this->input['sort'] : 'desc';
        $this->sort_mongo = ($this->sort == 'desc') ? -1 : 1;
        $this->max_images = isset($this->input['max_images']) && $this->input['max_images'] != '' ? $this->input['max_images'] : 1;

        $this->bench->end('core');
    }
    
}
