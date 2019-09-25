<?php


namespace App\Helpers;


class Constants
{
    public const TITLE_CONSTRAINTS = 'required|max:30|min:1';
    public const AUTHOR_CONSTRAINTS = 'required|max:30|min:2';
    public const PRICE_CONSTRAINTS = 'required';
    public const TITLE_REQUIRED_ERROR_MESSAGE = 'Title field is required';
    public const AUTHOR_REQUIRED_ERROR_MESSAGE = 'Author field is required';
    public const PRICE_REQUIRED_ERROR_MESSAGE = 'Price field is required';
    public const TITLE_MAX_ERROR_MESSAGE = 'Title should be maximum 30 characters';
    public const TITLE_MIN_ERROR_MESSAGE = 'Title should be minimum 1 character';
    public const AUTHOR_MAX_ERROR_MESSAGE = 'Author should be maximum 30 characters';
    public const AUTHOR_MIN_ERROR_MESSAGE = 'Author should be minimum 2 character';

    public const PAGE_SIZE = 20;
}
