<?php

namespace App\Repositories;

use App\User;

class PostRepository
{
    /**
     * 指定ユーザーの全ポスト取得
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return $user->posts()
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}