<?php

namespace Drupal\configure_block\Plugin\Condition;

use Drupal;
use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'IP based visibility' condition.
 *
 * @Condition(
 *   id = "check_ip",
 *   label = @Translation("IP Address")
 * )
 */
class CheckIP extends ConditionPluginBase {
    /**
    * Creates a new Block IP instance.
    *
    * @param array $configuration
    *   The plugin configuration, i.e. an array with configuration values keyed
    *   by configuration option name. The special key 'context' may be used to
    *   initialize the defined contexts by setting it to an array of context
    *   values keyed by context names.
    * @param string $plugin_id
    *   The plugin_id for the plugin instance.
    * @param mixed $plugin_definition
    *   The plugin implementation definition.
    */
    public function __construct(array $configuration, $plugin_id, $plugin_definition) {
        parent::__construct($configuration, $plugin_id, $plugin_definition);
    }
    /**
    * {@inheritdoc}
    */
    public static function create(array $configuration, $plugin_id, $plugin_definition) {
        return new static(
          $configuration,
          $plugin_id,
          $plugin_definition
        );
    }
    /**
     * Provide IP Address textarea to enter ip address for IP based condition
     * for block 
     * {@inheritdoc}
    */
    public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
        $form = parent::buildConfigurationForm($form, $form_state);
        // Disallow negation of this condition.
        unset($form['negate']);

        $config = $this->getConfiguration();
        $form['ban_ip'] = array(
            '#type' => 'textarea',
            '#title' => t('IP Address'),
            '#description' => t('enter only resticted ip address here. For multiple IP address use comma seperator'),
            '#default_value' => isset($config['ban_ip']) ? $config['ban_ip'] : '',
        );
        return $form;
    }
    /**
     * Validate is user entered correct IP address
    * {@inheritdoc}
    */
    public function validateConfigurationForm(array &$form, FormStateInterface $form_state){
        if (!empty($form_state->getValue('ban_ip'))) {
        $ip_address = explode(',',$form_state->getValue('ban_ip'));
            foreach ($ip_address as $ip) {
                if (!filter_var($ip, FILTER_VALIDATE_IP)) {
                    $form_state->setErrorByName('ban_ip', $this->t('Invalid IP address.'));
                }
            }
        }
    }
    /**
     * Submit user provided information to DB
    * {@inheritdoc}
    */
    public function submitConfigurationForm(array &$form, FormStateInterface $form_state){
        $this->configuration['ban_ip'] = $form_state->getValue('ban_ip');
        parent::submitConfigurationForm($form, $form_state);            
        
    }
    /**
     * Visibility check based on IP address added to block plugin
     * If user X-Forwarded IP  address is matched with Block IP address
     * then set visibility FALSE for the block
     * else Return TRUE
    * {@inheritdoc}
    */
    public function evaluate(){
        // Check if a setting has been set.
        if (empty($this->configuration['ban_ip'])) {
          return TRUE;
        }
        $userip =  \Drupal::request()->getClientIp();                
        $ip_address = array_filter(array_map('trim',explode(',',$this->configuration['ban_ip'])));
        return !in_array($userip,$ip_address); 
    }
    /**
    * {@inheritdoc}
    */
    public function summary(){
        $ip_address = [];
        if(!empty($this->configuration['ban_ip'])){
            $ip_address = $this->configuration['ban_ip'];
        }
        return $this->t('This blog will not be render for IP address @ip',['@ip'=>$ip_address]);
    }
    
    /**
    * {@inheritdoc}
    */
    public function getCacheContexts() {
        return Cache::mergeContexts(parent::getCacheContexts(), ['ip:check_ip']);
    }
    /**
    * {@inheritdoc}
    */
    public function defaultConfiguration() {
        return ['ban_ip' =>''] ;
    }
}
