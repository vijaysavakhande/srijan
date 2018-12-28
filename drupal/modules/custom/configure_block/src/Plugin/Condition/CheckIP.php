<?php

namespace Drupal\configure_block\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\HttpFoundation;
/**
 * Provides a 'IP based visibility' condition.
 *
 * @Condition(
 *   id = "check_ip",
 *   label = @Translation("IP Address")
 * )
 */
class CheckIP extends ConditionPluginBase {

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
    * {@inheritdoc}
    */
    public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
        $form = parent::buildConfigurationForm($form, $form_state);
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
    * {@inheritdoc}
    */
    public function submitConfigurationForm(array &$form, FormStateInterface $form_state){
        if(!empty($form_state->getValue('ban_ip'))){
            $this->configuration['ban_ip'] = $form_state->getValue('ban_ip');
            parent::submitConfigurationForm($form, $form_state);            
        }
    }
    /**
    * {@inheritdoc}
    */
    public function evaluate(){
        // Check if a setting has been set.
        if (empty($this->configuration['ban_ip'])) {
          return TRUE;
        }
        $userip =  \Drupal::request()->getClientIp();
        if(!empty($this->configuration['ban_ip'])){
            $ip_address = explode(',',$this->configuration['ban_ip']);
            if (!empty($ip_address)){
                foreach ($ip_address as $ip){
                    if ($ip == $userip){
                        return FALSE;
                        break;
                    }
                }
            }
        }
        return TRUE;
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
    * Determines whether condition result will be negated.
    *
    * @return bool
    *   Whether the condition result will be negated.
    */
    public function isNegated(){
        // Check if a setting has been set.
        if (empty($this->configuration['ban_ip'])) {
          return FALSE;
        }
        $userip =  \Drupal::request()->getClientIp();
        if(!empty($this->configuration['ban_ip'])){
            $ip_address = explode(',',$this->configuration['ban_ip']);
            if (!empty($ip_address)){
                foreach ($ip_address as $ip){
                    if ($ip == $userip){
                        return TRUE;
                        break;
                    }
                }
            }
        }
        return FALSE;
    }
}
