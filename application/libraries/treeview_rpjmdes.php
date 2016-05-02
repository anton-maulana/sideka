<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Treeview_rpjmdes{

		 
	 function buildTree($catArray)
	 {
	 	 global $obarray, $list;
	 
	 	 $list = '<ul>
		 ';
		 if (!is_array($catArray)) return '';
		 $obarray = $catArray;
		 
		 foreach($obarray as $item){
		 	 if($item['id_parent_rpjmdes'] == 0){
		 	 	 $mainlist = $this->_buildElements($item, 0);
		 	 }
		 }
		 $list .= '</ul>
		 ';
		 return $list;
	 }
	 
	 private function _buildElements($parent, $append)
	 {
		 
	 	 global $obarray, $list;
	 	 $list .= '
		 <li>
            <span><i class="">&nbsp</i>'. $parent['program'] .'</span>
            
		';

		 if($this->_hasChild($parent['id_rpjmdes'])){
		 	 $append++;
		 	 $list .= '<ul>';
		 	 $child = $this->_buildArray($parent['id_rpjmdes']);

			 foreach($child as $item){
				 $list .= $this->_buildElements($item, $append);
			 }
			 $list .= '</ul>';
		 }
	 }
	 
	 private function _hasChild($parent)
	 {
	 	 global $obarray;
		 $counter = 0;
		 foreach($obarray as $item){
			 if($item['id_parent_rpjmdes'] == $parent){
				 $counter++;
			 }
		 }
		 return $counter;
	 }
	 
	 private function _buildArray($parent)
	 {
	 	 global $obarray;
		 $bArray = array();
		 
		 foreach($obarray as $item){
			 if($item['id_parent_rpjmdes'] == $parent){
				 array_push($bArray, $item);
			 }
		 }
		 
		 return $bArray;
	 }

 }