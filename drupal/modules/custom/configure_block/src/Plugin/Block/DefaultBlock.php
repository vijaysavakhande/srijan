<?php
namespace Drupal\configure_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\file\Entity\File;
/**
 * Provides a 'CustomBlock' block.
 *
 * @Block(
 *   id = "custom_block",
 *   admin_label = @Translation("Custom Block"),
 *   category = @Translation("Configurable block")
 * )
 */
class DefaultBlock extends BlockBase implements BlockPluginInterface {
    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $formState){
        $form = parent::blockForm($form, $formState);
        $config = $this->getConfiguration();
        $form['title'] = array(
            '#type' => 'textfield',
            '#title' => t('Block Title'),
            '#description' => t('Enter the main heading'),
            '#default_value' => isset($config['title']) ? $config['title'] : '',
            '#required' => true
        );
        $form['image'] = array(
            '#type' => 'managed_file',
            '#upload_location' => 'public://upload/custom_block',
            '#title' => t('Image'),
            '#upload_validators' => [
                'file_validate_extensions' => ['jpg', 'jpeg', 'png', 'gif']
            ],
            '#default_value' => isset($this->configuration['image']) ? $this->configuration['image'] : '',
            '#description' => t('The image to display'),
            '#required' => true
        );
        $form['description'] = array(
            '#type' => 'text_format',
            '#title' => t('Description'),
            '#description' => t('Block Description'),
            '#format' => 'full_html',
            '#rows' => 30,
            '#default_value' => isset($config['description']['value']) ? $config['description']['value'] : '',
            '#required' => true
        );
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $formState){
        // Save image as permanent.
        $image = $formState->getValue('image');
        if ($image != $this->configuration['image']) {
          if (!empty($image[0])) {
            $file = File::load($image[0]);
            $file->setPermanent();
            $file->save();
          }
        }
        $this->configuration['title'] = $formState->getValue('title');
        $this->configuration['description'] = $formState->getValue('description');
        $this->configuration['image'] = $formState->getValue('image');
    }

    /**
     * {@inheritdoc}
     */
    public function build(){
        $build = [];
        $image = $this->configuration['image'];
        if (!empty($image[0])) {
          if ($file = File::load($image[0])) {
            $build['#image'] = [
              '#theme' => 'image',
              '#style_name' => 'medium',
              '#uri' => $file->getFileUri(),
            ];
          }
        }
        $build['#attached']['library'][] = 'configure_block/configure_block';
        $build['#cache']['max-age'] = 0;
        $build['#theme'] = 'configure_block_setup';
        $build['#title'] = $this->configuration['title'];
        $build['#description']= $this->configuration['description']['value'];
        return $build;
    }
}
