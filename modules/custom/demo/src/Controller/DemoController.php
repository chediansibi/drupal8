<?php


namespace Drupal\demo\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

class DemoController extends \Drupal\Core\Controller\ControllerBase {

    public function description () {
        $build = array(
            '#type' => 'markup',
            '#markup' => t('Hello world'),
        );

        return $build;
    }

public function requests () {

    $query = \Drupal::entityQuery('node');
    $nids = $query->execute();

    $query = \Drupal::entityQuery('user');
    $uids = $query->execute();

    $query = \Drupal::entityQuery('comment');
    $cids = $query->execute();

    $query = \Drupal::entityQuery('node')
            ->condition('type', 'horloge')
            ->condition('uid', 1);
        //condition('title', 'Ibidem', 'CONTAINS') %text%
        //condition('field.value', value)
    $filter_nids = $query->execute();

    $markup = 'Node nid : ' . implode(', ', $nids);
    $markup .= '<br /> User nid : ' . implode(', ', $uids);
    $markup .= '<br /> Comment nid : ' . implode(', ', $cids);
    
    $node = Node::load(reset($filter_nids));
    $markup .= '<br /><br />';
    $markup .='Corps du premier noeud:' . $node->title->value;

    $node->set('title', $node->title->value. '*');
           $node->save();
           $markup .= '<br />';
           $markup .= 'New Title :' . $node->title->value;

    $nodes = Node::loadMultiple($filter_nids);
        $markup .= '<br />';
        foreach ($nodes as $node) {
            $markup .= '<br>';
            $markup .= 'Email du fabriquant (nid' . $node->nid->value . ' ) :' .$node->field_email->value;
        }
    
        $result = db_query('SELECT field_image_alt'
            . ' FROM {node__field_image}'
            . ' WHERE entity_id= :nid', array(':nid' => 5));

        foreach ($result as $record) {
            $markup .= '<br><br>Texte alternatif:' . $record->field_image_alt;
        }
    $build = array(
        '#type' => 'markup',
        '#markup' => '$markup',
    );

    return $build;


}

}