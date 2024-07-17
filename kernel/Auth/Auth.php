<?php

namespace App\Kernel\Auth;

use App\Kernel\Config\Config;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Session\SessionInterface;

class Auth implements AuthInterface
{
    public function __construct(
        private DatabaseInterface $db,
        private SessionInterface $session,
        private Config $config,
    ) {}

    public function attempt(string $username, string $password): bool
    {
        $user = $this->db->select($this->table(), [
            $this->username() => $username,
        ]);

        //var_dump($user);
        if (! $user) {
            return false;
        }

        var_dump($user);
        if (! password_verify($password, $user[$this->password()])) {
            return false;
        }
        $this->session->set($this->sessionField(), $user['id']);

        return true;
    }

    public function logout(): void
    {
        $this->session->remove($this->sessionField());
    }

    public function check(): bool
    {
        return $this->session->has($this->sessionField());
    }

    public function user(): ?array
    {
        if (! ($this->check() == true)) {
            return null;
        } else {
            return $this->db->select($this->table(), [
                'id' => $this->session->get($this->sessionField()),
            ]);
        }
    }

    public function id(): ?int
    {
        // TODO: Implement id() method.
    }

    public function table(): string
    {
        return $this->config->get('auth.table', default: 'user');
    }

    public function username(): string
    {
        return $this->config->get('auth.username', default: 'email');
    }

    public function password(): string
    {
        return $this->config->get('auth.password', default: 'email');
    }

    public function sessionField(): string
    {
        return $this->config->get('auth.session_field', default: 'user_id');
    }
}
