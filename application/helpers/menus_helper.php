<?php
function createMenus($menus){
	$menusHtml = '<ul class="nav">';

	foreach($menus as $menu){
    $link = base_url($menu->link);
    $menusHtml .= "<li class='{$menu->status}'>
      <a href='{$link}'>
        <i class='{$menu->icon}'></i>
        <p>{$menu->name}</p>
      </a>
    </li>";
	}
  $menusHtml .="</ul>";
	return $menusHtml;
}
