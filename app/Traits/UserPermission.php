<?php

namespace App\Traits;

trait UserPermission
{
    public function checkRequestPermission()
    {
        if (
            empty(auth()->user()->role->permission['permission']['report']['list']) && \Route::is('report.index', 'type')
            // empty(auth()->user()->role->permission['permission']['user']['add']) && \Route::is('user.create') ||
            // empty(auth()->user()->role->permission['permission']['user']['edit']) && \Route::is('user.edit')
        ) {
            return abort(401);
        }
    }
}
