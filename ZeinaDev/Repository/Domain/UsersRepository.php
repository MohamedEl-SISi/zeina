<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\User;
use ZeinaDev\Repository\Interfaces\UsersRepositoryInterface;

class UsersRepository extends BaseRepository implements UsersRepositoryInterface
{
    function __construct(User $user)
    {
        parent::__construct($user);
    }
}
