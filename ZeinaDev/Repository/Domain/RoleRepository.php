<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\Roles;
use ZeinaDev\Repository\Interfaces\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    function __construct(Roles $role)
    {
        parent::__construct($role);
    }
}
