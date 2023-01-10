<?php

namespace Nanopkg\OrmCache\Traits;

use Illuminate\Support\Facades\Cache;

trait OrmCache
{

    // protected static $orm_cache_key = '';

    protected static $oldKeys = [];

    /**
     *
     * Cache table Data
     */
    public static function cacheData($column = 'id')
    {

        return Cache::rememberForever(self::$orm_cache_key, function () use ($column) {
            $query = static::orderBy($column, 'desc');
            if (isset(self::$cacheRelationshipKeys)) {
                foreach (self::$cacheRelationshipKeys as $key => $model) {
                    $query =  $query->with($key);
                }
            }
            return $query->get();
        });
    }

    /**
     *
     * Cache table Data
     */
    public static function cacheDataASC($column = 'id')
    {
        return Cache::rememberForever(self::$orm_cache_key . '_latest_', function () use ($column) {
            $query = static::orderBy($column, 'asc');
            if (isset(self::$cacheRelationshipKeys)) {
                foreach (self::$cacheRelationshipKeys as $key => $model) {
                    $query =  $query->with($key);
                }
            }
            return $query->get();
        });
    }
    /**
     *
     * Cache table first Data
     */
    public static function cacheDataFirst()
    {
        return Cache::rememberForever(self::$orm_cache_key . '_first_', function () {
            $query = new static;
            if (isset(self::$cacheRelationshipKeys)) {
                foreach (self::$cacheRelationshipKeys as $key => $model) {
                    $query =  $query->with($key);
                }
            }
            return $query->first();
        });
    }
    /**
     *
     * Cache table Last Data
     */
    public static function cacheDataLast($column = 'id')
    {
        return Cache::rememberForever(self::$orm_cache_key . '_last_', function () use ($column) {
            $query =  static::orderBy($column, 'desc');
            if (isset(self::$cacheRelationshipKeys)) {
                foreach (self::$cacheRelationshipKeys as $key => $model) {
                    $query =  $query->with($key);
                }
            }
            return $query->first();
        });
    }

    /**
     *
     * Cache table query
     */
    public static function cacheDataQuery($orm_cache_key, $query)
    {
        return Cache::rememberForever(self::$orm_cache_key . $orm_cache_key, function () use ($query) {
            return $query;
        });
    }
    /**
     *
     * Cache table cache
     */
    public static function forgetCache($orm_cache_key = null)
    {
        if (isset(self::$orm_cache_keys)) {

            foreach (self::$orm_cache_keys as $key) {
                Cache::forget(self::$orm_cache_key . $key);
            }
        }

        if (isset(self::$cacheRelationshipKeys)) {

            foreach (self::$cacheRelationshipKeys as $key => $model) {
                if (in_array($key, self::$oldKeys)) break;
                \array_push(self::$oldKeys, $key);
                $model::forgetCache();
            }
            self::$oldKeys = [];
        }

        Cache::forget(self::$orm_cache_key);
        Cache::forget(self::$orm_cache_key . '_latest_');
        Cache::forget(self::$orm_cache_key . '_first_');
        Cache::forget(self::$orm_cache_key . '_last_');
        if ($orm_cache_key) {
            Cache::forget(self::$orm_cache_key . $orm_cache_key);
        }
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($data) {
            $data->forgetCache();
        });

        static::updated(function ($data) {
            $data->forgetCache();
        });
        static::deleted(function ($data) {
            $data->forgetCache();
        });
    }
}
