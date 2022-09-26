<?php
// preprocess function for hot_models hotlock menu
function template_preprocess_layouthtml__get__get__articles_get_module_articles(&$vars) {
  $vars['items'] = $vars['element']['#items'];
  $vars['children'] = $vars['element']['#children'];
}