<?php

namespace ZeinaDev\Services\Domain;

use App\Core\Services\BaseService;
use App\Http\Helpers\Helpers;
use ZeinaDev\Repository\Interfaces\UsersRepositoryInterface;
use ZeinaDev\Services\Interfaces\UsersServiceInterface;


class UsersService extends BaseService implements UsersServiceInterface
{

        public function __construct(UsersRepositoryInterface $UsersRepository )
        {
            $this->_repo  = $UsersRepository;
        }

}
