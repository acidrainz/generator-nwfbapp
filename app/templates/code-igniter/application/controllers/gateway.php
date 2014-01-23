<?php

class Gateway extends CI_AMFGateway
{
    public function index()
    {
        $this->load->library('Amf');
        $config = new Amfphp_Core_Config();//do something with config object here
        $config->serviceFolderPaths = array(dirname(__FILE__).'/services/');
        $gateway = Amfphp_Core_HttpRequestGatewayFactory::createGateway($config);

        $output = $gateway->service();
        $response = $gateway->getResponseHeaders();
        foreach ($response as $res) {
            $this->output->set_header($res);
        }
        $this->output->set_output($output);
    }

}

