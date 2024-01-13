<?php

namespace App\Traits;

trait UserPermission
{
    public function checkRequestPermission()
    {
        if (
            /**billing */
            empty(auth()->user()->role->permission['permission']['billing']['list']) && \Route::is('billing.index') ||
            empty(auth()->user()->role->permission['permission']['billing']['add']) && \Route::is('billing.create') ||
            empty(auth()->user()->role->permission['permission']['billing']['edit']) && \Route::is('billing.edit') ||
            empty(auth()->user()->role->permission['permission']['billing']['view']) && \Route::is('billing.show') ||
            empty(auth()->user()->role->permission['permission']['billing']['delete']) && \Route::is('billing.destroy') ||

            empty(auth()->user()->role->permission['permission']['billing']['pdf']) && \Route::is('billing.pdf','id') ||
            empty(auth()->user()->role->permission['permission']['billing']['print']) && \Route::is('billing.print', 'id') ||
           
            /**role */
            empty(auth()->user()->role->permission['permission']['role']['list']) && \Route::is('role.index') ||
            empty(auth()->user()->role->permission['permission']['role']['add']) && \Route::is('role.create') ||
            empty(auth()->user()->role->permission['permission']['role']['edit']) && \Route::is('role.edit') ||
            empty(auth()->user()->role->permission['permission']['role']['view']) && \Route::is('role.show') ||
            empty(auth()->user()->role->permission['permission']['role']['delete']) && \Route::is('role.destroy') ||

            /**permission */
            empty(auth()->user()->role->permission['permission']['permission']['list']) && \Route::is('permission.index') ||
            empty(auth()->user()->role->permission['permission']['permission']['add']) && \Route::is('permission.create') ||
            empty(auth()->user()->role->permission['permission']['permission']['edit']) && \Route::is('permission.edit') ||
            empty(auth()->user()->role->permission['permission']['permission']['view']) && \Route::is('permission.show') ||
            empty(auth()->user()->role->permission['permission']['permission']['delete']) && \Route::is('permission.destroy') ||

            /**employee */
            empty(auth()->user()->role->permission['permission']['employee']['list']) && \Route::is('employee.index') ||
            empty(auth()->user()->role->permission['permission']['employee']['add']) && \Route::is('employee.create') ||
            empty(auth()->user()->role->permission['permission']['employee']['edit']) && \Route::is('employee.edit') ||
            empty(auth()->user()->role->permission['permission']['employee']['view']) && \Route::is('employee.show') ||
            empty(auth()->user()->role->permission['permission']['employee']['delete']) && \Route::is('employee.destroy') ||
            /** customer */
            empty(auth()->user()->role->permission['permission']['customer']['list']) && \Route::is('customer.index')||
            empty(auth()->user()->role->permission['permission']['customer']['add']) && \Route::is('customer.create') ||
            empty(auth()->user()->role->permission['permission']['customer']['edit']) && \Route::is('customer.edit') ||
            empty(auth()->user()->role->permission['permission']['customer']['view']) && \Route::is('customer.show') ||
            empty(auth()->user()->role->permission['permission']['customer']['delete']) && \Route::is('customer.destroy') ||
            /** report */
            empty(auth()->user()->role->permission['permission']['report']['list']) && \Route::is('report.index', 'type') ||
            // setting
            empty(auth()->user()->role->permission['permission']['setting']['list']) && \Route::is('setting.list')||
            empty(auth()->user()->role->permission['permission']['setting']['edit']) && \Route::is('setting.edit') ||

            //contact
            empty(auth()->user()->role->permission['permission']['contact']['list']) && \Route::is('contact.index')||
            empty(auth()->user()->role->permission['permission']['contact']['edit']) && \Route::is('contact.edit', 'id')
        
        
        
            ) {
            return abort(401);
        }
    }
}
