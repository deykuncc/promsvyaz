<?php

namespace App\Services;

use App\Exceptions\CannotDestroyUserException;
use App\Exceptions\CannotStoreUserException;
use App\Exceptions\CannotUpdateUserException;
use App\Exceptions\CannotUpdateUserLoginException;
use App\Models\ActionLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UsersService
{
    /**
     * @param array $data
     * @return void
     * @throws CannotStoreUserException
     */
    public function store(array $data): void
    {
        $this->formatName($data);

        DB::beginTransaction();
        try {
            $user = User::query()->create($data);
            ActionLogger::log(ActionLog::STORE, ActionLog::USER, $user?->id, ['name' => $user?->fullName()]);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            throw new CannotStoreUserException();
        }
    }

    /**
     * @param int $userId
     * @param array $data
     * @return void
     * @throws CannotUpdateUserException
     * @throws CannotUpdateUserLoginException
     */
    public function update(int $userId, array $data): void
    {
        $user = User::query()->lockForUpdate()->where('id', '=', $userId)->first();
        if ($user->login != $data['login']) {
            if (User::query()->where('login', '=', $data['login'])->exists()) {
                throw new CannotUpdateUserLoginException();
            }
        }

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $this->formatName($data);
        DB::beginTransaction();
        try {
            User::query()->where('id', $userId)->lockForUpdate()->update($data);
            $user = User::query()->where('id', $userId)->first();
            ActionLogger::log(ActionLog::UPDATE, ActionLog::USER, $userId, ['name' => $user?->fullName()]);
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            throw new CannotUpdateUserException();
        }
    }

    /**
     * @param int $userId
     * @return void
     * @throws CannotDestroyUserException
     */
    public function destroy(int $userId): void
    {
        DB::beginTransaction();
        try {
            $user = User::query()->where('id', '=', $userId)->first();
            ActionLogger::log(ActionLog::DELETE, ActionLog::USER, $userId, ['name' => $user?->fullName()]);
            User::query()->where('id', $userId)->delete();
            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            throw new CannotDestroyUserException();
        }
    }

    private function formatName(array &$data): void
    {
        $name = explode(' ', $data['name']);
        $data['last_name'] = $name[0];
        $data['first_name'] = $name[1];
        $data['middle_name'] = $name[2] ?? null;
        unset($data['name']);
    }
}
