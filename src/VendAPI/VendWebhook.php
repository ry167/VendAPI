<?php

/**
 * VendAPI 
 *
 * An api for communicating with vend pos software - http://www.vendhq.com
 *
 * Requires php 5.3
 *
 * @package    VendAPI
 * @author     Bruce Aldridge <bruce@incode.co.nz>
 * @copyright  2012-2013 Bruce Aldridge
 * @license    http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0
 * @link       https://github.com/brucealdridge/vendapi
 */

namespace VendAPI;

class VendWebhook extends VendObject
{
    public function __construct($data = null, &$v = null)
    {

        parent::__construct($data, $v);
        $this->vend = $v;
        if ($data) {
            foreach ($data as $key => $value) {
                $this->vendObjectProperties[$key] = $value;
            }
            $this->initialObjectProperties = $this->vendObjectProperties;
        }
    }
    /**
     * will create/update the webhook using the vend api and this object will be updated
     * @return null
     */
    public function create()
    {
        // wipe current user and replace with new objects properties
        $this->vendObjectProperties = $this->vend->requestr->post('/api/webhooks', json_encode($this->toArray()));
    }

    public function update()
    {
        $this->vendObjectProperties = $this->vend->requestr->put('/api/webhooks', json_encode($this->toArray()));
    }

    public function delete()
    {
        $return = $this->vend->requestr->delete('/api/webhooks', json_encode($this->toArray()));
        return ($return['status'] == 'success');
    }

    /**
     * Validate the latest webhook
     * @return boolean
     * @todo  Finish this function
     */
    public function validate()
    {
        //Grab signature from within headers. Looks like `X-Signature: signature=897hRT893qkA783M093ha903f,algorithm=HMAC-SHA256`
        //$data = $body;
        //$secret = $client_secret;
        if ($hmax_header == hash_hmac('sha256', $data, $secret, TRUE)){
            //valid
        } else {

        }
    }
}
