<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stocksync extends CI_Controller{

    public function index()
    {
        $this->load->model('ion_auth_model');
        $product_identifier = $this->input->post('product_identifier');
        $stock = $this->input->post('stock');
        $wp_posts_info_array = $this->ion_auth_model->get_wp_posts_info($product_identifier)->result_array();
        if(!empty($wp_posts_info_array))
        {
            $wp_posts_info = $wp_posts_info_array[0];
            $ID = $wp_posts_info['ID'];
            $wp_postmeta_info_array = $this->ion_auth_model->get_wp_postmta_info($ID)->result_array();
            if(!empty($wp_postmeta_info_array))
            {
                $wp_postmeta_info = $wp_postmeta_info_array[0];
                $meta_id = $wp_postmeta_info['meta_id'];
                $this->ion_auth_model->update_wp_postmeta_info($meta_id, $stock);
            }            
        }      
    }
}
