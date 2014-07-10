<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Home extends CI_Controller{

    public function index(){

        $this->runTest();
       /* $result = shell_exec('cd ../../../altests && behat --tags \'@first\'');


        if(strpos($result, '4 passed')!= FALSE)
                $data['val'] = "success";
        else
            $data['val'] = "Failure!!!";
         
        $this->load->view('home_view',$data);*/
    }
    public function runTest(){

         $dir = '../../../altests/features/';


        $arr = array();
       $exclude = array( ".","..","error_log","_notes" );
       if (is_dir($dir)) {
          $features = scandir($dir);
          //$features = glob($dir.'*.{feature}', GLOB_BRACE);
        foreach($features as $feature){
             if(!in_array($feature,$exclude)&& strpos($feature, '.feature')!= FALSE && strpos($feature, '.feature~')== FALSE){
                    $arr[]= $feature;
                    //echo '<li><a href="showFeature?var='.$feature.'">'.$feature.'</a></li>';
            }
         }
         $data['features']=$arr;
         //$this->load->view('view_displayFeatures',$data);
       }
        $this->load->view('view_createFeature',$data);

    }
    public function test(){

        echo "here";
    }
    public function display(){//not used now i guess

        $dir = '../../../altests/features/';

        
        $arr = array();
       $exclude = array( ".","..","error_log","_notes" );
       if (is_dir($dir)) {
          $features = scandir($dir);
          //$features = glob($dir.'*.{feature}', GLOB_BRACE);
        foreach($features as $feature){
             if(!in_array($feature,$exclude)&& strpos($feature, '.feature')!= FALSE && strpos($feature, '.feature~')== FALSE){
                    $arr[]= $feature;
                    //echo '<li><a href="showFeature?var='.$feature.'">'.$feature.'</a></li>';
            }
         }
         $data['features']=$arr;
         $this->load->view('view_displayFeatures',$data);
       }
    }
    public function showFeature(){

        
        $dir = '../../../altests/features/';
        $feature = $this->input->get('var');
        $resource = fopen($dir.$feature, "r");
        $tags = fgets($resource);
        $contents = fread($resource, filesize($dir.$feature));
        //$tags = split(" ", $contents);
        $tagsarr = explode(" ", $tags);
        $data['tags'] = $tags;
        $data['contents'] = $contents;
        $data['tagsarr'] = $tagsarr;
        $this->load->view('view_runFeature',$data);
        
    }
    public function testFeature(){

        $tag =  $_POST['data'];
        $result = "Not set yet";
        $result = shell_exec('cd ../../../altests && behat --tags \''.$tag.'\'');


        if(strpos($result, 'failed')== FALSE){
                $data['result'] = "Success<br><hr><pre>".$result."</pre>";
                $data['bool'] = true;
        }
        else {
            $data['result'] = "Failure!!!".'<br><hr><pre>'.$result.'<pre>';
             $data['bool'] = false;
        }

        $this->load->view('view_results',$data);
    }
}

?>
