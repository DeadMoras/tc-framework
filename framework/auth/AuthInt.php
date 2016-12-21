<?php

namespace framework\auth;

interface AuthInt {
    /**
     *
     * @param array $data
     */
    public function attempt(array $data);
}
