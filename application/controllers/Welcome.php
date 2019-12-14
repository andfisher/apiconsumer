<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Andrew Fisher
 */
class Welcome extends CI_Controller
{
	public function index()
	{
		$this->load->view('index/index');
	}

    public function contacts()
    {
        # Always set a JSON Content-Type, even on failures
        $this->output->set_content_type('application/json');


        # Load the config from our custom file in application/config
        $this->load->config('rewardgateway', true);

        try {

            $service = new Services\RewardGateway($this->config->item('rewardgateway'));
            $response = $service->fetch();

			$this->responseJson($response);

        } catch (Services\RewardGateway\Exception $exception) {
            # Service threw Exceptions. Nothing the user did wrong
            $this->output->set_status_header(500);
            $this->responseJson((object) ['code' => 1, 'message' => $exception->getMessage()]);
        }
    }

    private function responseJson($json): void
    {
        $this->output->set_output(json_encode($json));
        $this->output->_display();
        exit;
    }
}
