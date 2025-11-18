<?php

namespace PlanetHoster\Api\Hosting;

use PlanetHoster\Api\Api;

class Emails extends Api
{

    /**
     * @return stdClass
     */
    public function List($hosting_id)
    {
        $content = $this->adapter->get('/v3/hosting/emails', [
            'id' => $hosting_id,
        ]);
        return json_decode($content);
    }

    /**
     * @return stdClass
     */
    public function Create($hosting_id, $password, $mail_user, $domain, $quota = null)
    {
        $content = $this->adapter->post('/v3/hosting/email', [
            'id' => $hosting_id,
            'password' => $password,
            'mailUser' => $mail_user,
            'domain' => $domain,
            'quota' => $quota
        ]);
        return json_decode($content);
    }

    /**
     * @return stdClass
     */
    public function Update($hosting_id, $password, $mail_user, $domain, $quota = null)
    {
        $content = $this->adapter->patch('/v3/hosting/email', [
            'id' => $hosting_id,
            'password' => $password,
            'mailUser' => $mail_user,
            'domain' => $domain,
            'quota' => $quota
        ]);
        return json_decode($content);
    }

    /**
     * @return stdClass
     */
    public function Delete($hosting_id, $mail_user, $domain)
    {
        $content = $this->adapter->delete('/v3/hosting/email', [
            'id' => $hosting_id,
            'mailUser' => $mail_user,
            'domain' => $domain,
        ]);
        return json_decode($content);
    }

    /**
     * @return stdClass
     */
    public function Suspend($hosting_id, $email)
    {
        $content = $this->adapter->post('/v3/hosting/email/suspend', [
            'id' => $hosting_id,
            'email' => $email,
        ]);
        return json_decode($content);
    }

    /**
     * @return stdClass
     */
    public function Unsuspend($hosting_id, $email)
    {
        $content = $this->adapter->post('/v3/hosting/email/unsuspend', [
            'id' => $hosting_id,
            'email' => $email,
        ]);
        return json_decode($content);
    }
}
