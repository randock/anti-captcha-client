<?php

declare(strict_types=1);

namespace Randock\AntiCaptcha\Exception;

class InvalidRequestException extends \Exception
{
    public const ERROR_KEY_DOES_NOT_EXIST = 1;
    public const ERROR_NO_SLOT_AVAILABLE = 2;
    public const ERROR_ZERO_CAPTCHA_FILESIZE = 3;
    public const ERROR_TOO_BIG_CAPTCHA_FILESIZE = 4;
    public const ERROR_ZERO_BALANCE = 10;
    public const ERROR_IP_NOT_ALLOWED = 11;
    public const ERROR_CAPTCHA_UNSOLVABLE = 12;
    public const ERROR_BAD_DUPLICATES = 13;
    public const ERROR_NO_SUCH_METHOD = 14;
    public const ERROR_IMAGE_TYPE_NOT_SUPPORTED = 15;
    public const ERROR_NO_SUCH_CAPCHA_ID = 16;
    public const ERROR_EMPTY_COMMENT = 20;
    public const ERROR_IP_BLOCKED = 21;
    public const ERROR_TASK_ABSENT = 22;
    public const ERROR_TASK_NOT_SUPPORTED = 23;
    public const ERROR_INCORRECT_SESSION_DATA = 24;
    public const ERROR_PROXY_CONNECT_REFUSED = 25;
    public const ERROR_PROXY_CONNECT_TIMEOUT = 26;
    public const ERROR_PROXY_READ_TIMEOUT = 27;
    public const ERROR_PROXY_BANNED = 28;
    public const ERROR_PROXY_TRANSPARENT = 29;
    public const ERROR_RECAPTCHA_TIMEOUT = 30;
    public const ERROR_RECAPTCHA_INVALID_SITEKEY = 31;
    public const ERROR_RECAPTCHA_INVALID_DOMAIN = 32;
    public const ERROR_RECAPTCHA_OLD_BROWSER = 33;
    public const ERROR_RECAPTCHA_STOKEN_EXPIRED = 34;
    public const ERROR_PROXY_HAS_NO_IMAGE_SUPPORT = 35;
    public const ERROR_PROXY_INCOMPATIBLE_HTTP_VERSION = 36;
}
