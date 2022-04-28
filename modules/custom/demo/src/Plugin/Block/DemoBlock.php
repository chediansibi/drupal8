<?php

namespace Drupal\demo\Plugin\Block;

use Drupal\Core\block\BlockBase;
/**
 * Message de commentaire
 * 
 * @Block (
 *    id = "block_demo",
 * admin_label = "another Hello World",
 * )
 */

 class DemoBlock extends BlockBase {
     public function build () {
         return array (
             '#markup' => 'Hello world again!',
         );
     }
 }