<?php

namespace App\Policies;

use App\Models\Pembelian;
use App\Models\User;

class PembelianPolicy
{
    public function viewAny(User $user): bool { return $user->role === 'admin'; }
    public function create(User $user): bool   { return $user->role === 'admin'; }
    public function update(User $user, Pembelian $pembelian): bool { return $user->role === 'admin'; }
    public function delete(User $user, Pembelian $pembelian): bool { return $user->role === 'admin'; }
}
