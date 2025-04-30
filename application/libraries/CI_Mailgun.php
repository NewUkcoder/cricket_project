<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'third_party/mailgun/vendor/autoload.php';
use Mailgun\Mailgun;
use Mailgun\HttpClient\HttpClientConfigurator;
use Mailgun\Hydrator\NoopHydrator;

class CI_Mailgun {
    
    /**
     * Mailgun client instance
     * @var Mailgun
     */
    private $mg;
    
    /**
     * Mailgun domain
     * @var string
     */
    private $domain;
    
    /**
     * Default sender address
     * @var string
     */
    private $from;
    
    /**
     * API endpoint (EU/US)
     * @var string
     */
    private $api_endpoint = 'https://api.mailgun.net'; // Change to 'https://api.eu.mailgun.net' for EU region

    /**
     * Constructor - Initializes Mailgun client
     */
    public function __construct() {
        // Load CodeIgniter instance
        $this->ci =& get_instance();
        
        // Load configuration
        $this->ci->config->load('mailgun', true);
        
        // Configure client
        $configurator = new HttpClientConfigurator();
        $configurator->setApiKey($this->ci->config->item('mailgun_api_key', 'mailgun'));
        $configurator->setEndpoint($this->api_endpoint);
        
        $this->mg = new Mailgun(
            $configurator,
            new NoopHydrator() // Better performance for simple sends
        );
        
        $this->domain = $this->ci->config->item('mailgun_domain', 'mailgun');
        $this->from = $this->ci->config->item('mailgun_from', 'mailgun');
    }

    /**
     * Send email via Mailgun
     *
     * @param string|array $to Recipient email(s)
     * @param string $subject Email subject
     * @param string $message HTML/Text content
     * @param array $options Additional options
     *        - cc: Carbon copy recipients
     *        - bcc: Blind carbon copy recipients
     *        - attachment: File path to attach
     *        - tags: Array of tracking tags
     *        - variables: Array of template variables
     * @return mixed Message ID on success, false on failure
     */
    public function send($to, $subject, $message, $options = []) {
        try {
            // Base message parameters
            $params = [
                'from'    => $this->from,
                'to'      => is_array($to) ? implode(', ', $to) : $to,
                'subject' => $subject,
                'html'    => $message
            ];

            // Add optional parameters
            if (!empty($options['cc'])) {
                $params['cc'] = is_array($options['cc']) ? 
                    implode(', ', $options['cc']) : $options['cc'];
            }
            
            if (!empty($options['bcc'])) {
                $params['bcc'] = is_array($options['bcc']) ? 
                    implode(', ', $options['bcc']) : $options['bcc'];
            }
            
            if (!empty($options['tags']) && is_array($options['tags'])) {
                $params['o:tag'] = $options['tags'];
            }
            
            if (!empty($options['variables'])) {
                $params['v:custom-data'] = json_encode($options['variables']);
            }

            // Handle attachments
            if (!empty($options['attachment'])) {
                if (is_array($options['attachment'])) {
                    foreach ($options['attachment'] as $file) {
                        $params['attachment'][] = ['filePath' => $file];
                    }
                } else {
                    $params['attachment'][] = ['filePath' => $options['attachment']];
                }
            }

            // Send message
            $result = $this->mg->messages()->send($this->domain, $params);
            
            // Log successful send
            log_message('info', 'Mailgun email sent to: ' . $params['to'] . ' | Message ID: ' . $result->getId());
            
            return $result->getId();

        } catch (Exception $e) {
            // Log detailed error
            log_message('error', 'Mailgun Error: ' . $e->getMessage());
            log_message('debug', 'Failed payload: ' . print_r($params ?? [], true));
            
            return false;
        }
    }
}