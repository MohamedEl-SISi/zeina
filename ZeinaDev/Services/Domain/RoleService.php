<?php

namespace ZeinaDev\Services\Domain;

use App\Core\Services\BaseService;
use App\Http\Helpers\Helpers;
use ZeinaDev\Repository\Interfaces\RoleRepositoryInterface;
use ZeinaDev\Services\Interfaces\RoleServiceInterface;


class RoleService extends BaseService implements RoleServiceInterface
{

        public function __construct(RoleRepositoryInterface $RoleRepository )
        {
            $this->_repo  = $RoleRepository;
        }

}
