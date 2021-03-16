<?php

namespace Eduka\Cube\Services;

use Eduka\Cube\Models\ApplicationLog as ApplicationLogModel;
use Eduka\Cube\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApplicationLog
{
    public static function __callStatic($method, $args)
    {
        return ApplicationLogService::new()->{$method}(...$args);
    }
}

class ApplicationLogService
{
    protected $model;
    protected $causer;
    protected $keepProcess;
    protected $parameters = [];
    protected $description;

    public function __construct()
    {
        $this->keepProcess = false;
    }

    public static function new(...$args)
    {
        return new self(...$args);
    }

    public function parameters(array $parameters, bool $new = false)
    {
        return tap($this, function () use ($parameters) {
            $this->parameters = array_merge($this->parameters, $parameters);
        });
    }

    public function model(Model $model)
    {
        return tap($this, function () use ($model) {
            $this->model = $model;
        });
    }

    public function keepProcess()
    {
        return tap($this, function () {
            $this->keepProcess = true;
        });
    }

    public function log(string $description = null)
    {
        $this->description = $description;
        $this->assessProcess();

        $log = new ApplicationLogModel();
        $log->causer()->associate($this->causer ?? $this->setDefaultCauser());
        $log->process = session('eduka.application-log.process');
        $log->description = $description;
        $log->parameters = $this->parameters;
        $log->loggable()->associate($this->model);
        $log->push();
    }

    public function causer(User $user)
    {
        return tap($this, function () use ($user) {
            $this->causer = $user;
        });
    }

    private function setDefaultCauser()
    {
        return $this->causer = $causer ?? Auth::user() ?? null;
    }

    private function assessProcess()
    {
        /*
         * Regenerate the process in case it doesn't exist at all or it's being
         * explicitly asked to be regenerated.
         */
        if (($this->keepProcess &&
             empty(session('eduka.application-log.process'))) ||
             ! $this->keepProcess) {
            session(['eduka.application-log.process' => (string) Str::random(20)]);
        }
    }
}
