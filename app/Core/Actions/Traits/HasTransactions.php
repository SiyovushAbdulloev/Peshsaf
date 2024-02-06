<?php

namespace App\Core\Actions\Traits;

use Illuminate\Database\DatabaseManager;

trait HasTransactions
{
    protected static $transationOwner = null;

    protected function getDatabaseManager(): DatabaseManager
    {
        return app(DatabaseManager::class);
    }

    protected function beginTransaction()
    {
        if ($this->hasLock()) {
            return;
        }
        $this->lock();
        $this->getDatabaseManager()->beginTransaction();
    }

    protected function lock()
    {
        self::$transationOwner = spl_object_hash($this);
    }

    protected function rollBack()
    {
        if ($this->isTransactionOwner()) {
            $this->getDatabaseManager()->rollBack();
            $this->unlock();
        }
    }

    protected function commit()
    {
        if ($this->isTransactionOwner()) {
            $this->getDatabaseManager()->commit();
            $this->unlock();
        }
    }

    protected function hasLock(): bool
    {
        return !is_null(self::$transationOwner);
    }

    protected function unlock()
    {
        self::$transationOwner = null;
    }

    protected function beforeRollback()
    {
    }

    protected function beforeCommit()
    {
    }

    protected function afterCommit(...$params)
    {
    }

    protected function isTransactionOwner()
    {
        return self::$transationOwner === spl_object_hash($this);
    }
}

