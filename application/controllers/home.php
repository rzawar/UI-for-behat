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
       $data['browsers']= $this->getBrowsers();
        $this->load->view('view_homePage',$data);

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
        $dirFeatur = '../../../altests/';
        $feature = $this->input->get('var');
        $resource = fopen($dir.$feature, "r");
        $tags = fgets($resource);
        $contents = fread($resource, filesize($dir.$feature));
        //$tags = split(" ", $contents);
        $browsers = fread(fopen($dirFeatur.'browsers',"r"),  filesize($dirFeatur.'browsers'));
        $tagsarr = explode(" ", $tags);
        $data['tags'] = $tags;
        $data['contents'] = $contents;
        $data['tagsarr'] = $tagsarr;
        $data['browsers'] = explode("\n",$browsers);
        $this->load->view('view_runFeature',$data);
        
    }
    public function testFeature(){

        $tag =  $_POST['data'];
        $browser = $_POST['browserval'];
        $result = "Not set yet";
        $command = 'cd ../../../altests && behat -p \''.$browser.'\' --tags \''.$tag.'\'';
      
        $result = shell_exec($command);
        $data['browser'] = $browser;
        $data['command'] = $command;

        if(strpos($result, 'failed')== FALSE ){
                $data['result'] = "Success<br><hr><pre>".$result."</pre>";
                $data['bool'] = true;
        }
        else {
            $data['result'] = "Failure!!!".'<br><hr><pre>'.$result.'<pre>';
             $data['bool'] = false;
        }

        $this->load->view('view_results',$data);
    }
    public function checkDifference(){
        $images = directory_map('./application/img');
        $data['images']= $images;
        $this->load->view('view_difference',$data);
    }
    public function getBrowsers(){

        $dirFeatur = '../../../altests/';

        return explode("\n",fread(fopen($dirFeatur.'browsers',"r"),  filesize($dirFeatur.'browsers')));
    }
    public function testBaseFeature(){

         $browser = "default browser";//$_POST['browserval'];
        $result = "Not set yet";
        $command = 'cd ../../../altests && behat -p \''.$browser.'\' --tags \'@getBase\'';

        $result = "rohit";//shell_exec($command);
        $data['browser'] = $browser;
        $data['command'] = $command;

        if(strpos($result, 'failed')== FALSE ){
                $data['result'] = "Success<br><hr><pre>".$result."</pre>";
                $data['bool'] = true;
        }
        else {
            $data['result'] = "Failure!!!".'<br><hr><pre>'.$result.'<pre>';
             $data['bool'] = false;
        }
        $data['browsers'] = $this->getBrowsers();

        $this->load->view('view_compareBrowser',$data);
    }

    public function compareBrowsers(){

        $selBrowsers =  $_POST['selBrowsers'];

        print_r($selBrowsers);
        $output = "Result of all test is \n";
        foreach ($selBrowsers as $browser) {
            $command = 'cd ../../../altests && behat -p \''.$browser.'\' --tags \'@compare\'';
            $result = shell_exec($command);
            if(strpos($result, 'failed')== TRUE ){
                $output = "Something went wrong with ".$command;
                    break;
            }
           $output .= $command." is success \n";
        }
        $data['result']=$output;
        $data['bool'] = true;
        $data['command']="Demo";
         $this->load->view('view_results',$data);
    }
}

?>
