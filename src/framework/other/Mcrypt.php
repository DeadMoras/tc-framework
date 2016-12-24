<?php

namespace framework\other;

class Mcrypt
{
    /**
     *
     * @var string
     *
     * just change that key
     */
    private $key = 'ke01MKwe182.3LKwq1ke/.s1';

    /**
     *
     * @param mixed $data
     * @return string
     */
    public function encrypt($data)
    {
        $data = serialize($data);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $text = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $data, MCRYPT_MODE_ECB, $iv);

        return $text;
    }

    /**
     *
     * @param string $data
     * @return string
     */
    public function decrypt($data)
    {
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $text = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, $data, MCRYPT_MODE_ECB, $iv);

        return unserialize($text);
    }
}
