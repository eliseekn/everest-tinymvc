<?php

/**
 * @copyright 2021 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/tinymvc
 */

namespace App\Http\Validators;

use Core\Http\Validator\GUMPValidator;

class StoreCommentValidator extends GUMPValidator
{
    /**
     * Validation rules
     */
    protected static array $rules = [
        'author' => 'required',
        'content' => 'required',
    ];

    /**
     * Custom errors messages
     */
    protected static array $messages = [
        //
    ];

    /**
     * Make validator
     */
    public static function make(array $inputs)
    {
        return self::validate($inputs, static::$rules, static::$messages);
    }
}