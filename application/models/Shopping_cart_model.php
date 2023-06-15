
<?php
class Shopping_cart_model extends CI_Model
{
 function fetch_user_shopping_cart($user_id)
 {
    $this->db->select('cart.item_id as item_id,course.course_name as course_name,course.course_image as course_image,cart.course_id as course_id,course.course_price as price,course.course_author as course_author');
    $this->db->from('shopping_cart_item as cart, course');
    $this->db->where('cart.user_id',$user_id);
    $this->db->where('course.course_id=cart.course_id');
    $query = $this->db->get();
    return $query->result();
 }
 function add_course($arr){
    $result=$this->db->insert('shopping_cart_item',$arr);
    if(!empty($result)){
        return True;
    }else{
        return False;
    }
 }
 function remove_from_cart($item_id){
  $this->db->delete('shopping_cart_item', array('item_id' => $item_id)); 
 }
 function empty_shopping_cart($user_id){
  $this->db->delete('shopping_cart_item', array('user_id' => $user_id));
 }
}
