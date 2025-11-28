<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

trait AuditableTrait
{
    public static function bootAuditableTrait()
    {
        static::updated(function (Model $model) {
            if (auth()->check()) {
                try {
                    $oldValues = array_diff_assoc($model->getOriginal(), $model->getAttributes());
                    $newValues = array_intersect_key($model->getAttributes(), $oldValues);

                    AuditLog::logAction(
                        'update',
                        class_basename($model),
                        $model->id,
                        $oldValues,
                        $newValues
                    );
                } catch (\Throwable $e) {
                    Log::warning('Audit log failed for update', ['error' => $e->getMessage()]);
                }
            }
        });

        static::deleted(function (Model $model) {
            if (auth()->check()) {
                try {
                    AuditLog::logAction(
                        'delete',
                        class_basename($model),
                        $model->id,
                        $model->getAttributes(),
                        null
                    );
                } catch (\Throwable $e) {
                    Log::warning('Audit log failed for delete', ['error' => $e->getMessage()]);
                }
            }
        });

        static::created(function (Model $model) {
            if (auth()->check()) {
                try {
                    AuditLog::logAction(
                        'create',
                        class_basename($model),
                        $model->id,
                        null,
                        $model->getAttributes()
                    );
                } catch (\Throwable $e) {
                    Log::warning('Audit log failed for create', ['error' => $e->getMessage()]);
                }
            }
        });
    }
}
