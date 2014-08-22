<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Home extends CI_Controller{

    
    protected $_baseBrowser;
    protected $_testBrowsers;
    public function home() {
        parent::__construct();

       
        
    }

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

        $dir = '../../../altests/features/';
        $dirFeatur = '../../../altests/';
        $resource = fopen($dir."screenshotFeature.feature", "r");
        $contents = fread($resource, filesize($dir."screenshotFeature.feature"));
        $data['contentsSC'] = $contents;

        $resource1 = fopen($dir."getBase.feature", "r");
        $contents1 = fread($resource1, filesize($dir."getBase.feature"));
        $data['contents'] = $contents1;

        $resourcebehat = fopen("../../../altests/behat.yml", "r");
        $contentsbehat = fread($resourcebehat, filesize("../../../altests/behat.yml"));
        $data['contentsBehat'] = $contentsbehat;

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
        $server = $_POST['serverval'];       
        $browser = $_POST['browserval'];
      
        $result = "Not set yet";
        /*switch ($server) {
            case "Development":
                $url = "http://angiesmr2dev.prod.acquia-sites.com/";
                break;
            case "Production":
                $url = "http://angiesmr2.prod.acquia-sites.com/";
                break;
            case "Staging":
                $url = "http://angiesmr2stg.prod.acquia-sites.com/";
                break;
            default:
                break;
        }*/
        $setServer = $this->getServerURL($server);
        $command = 'cd ../../../altests &&'.$setServer.'&& behat -p \''.$browser.'\' --tags \''.$tag.'\'';
        //$isServerSet =  shell_exec($setServer);
        
        $result = shell_exec($command);
        $data['browser'] = $browser;
        $data['command'] = $command;

        if($result == ""){
           $data['result'] = "Failure!!! returned empty check command line";
            $data['bool'] = false;
        }
        else  if(strpos($result,'You can implement step definitions for undefined steps with these snippets:')== TRUE){
                    $data['result'] = "Failure!!! returned empty check command line , Check your feature file";
                    $data['bool'] = false;
                }
                else if(strpos($result, 'failed')== FALSE ){
                            $data['result'] = "Success<br><hr><pre>".$result."</pre>";
                            $data['bool'] = true;
                     }
                     else {
                            $data['result'] = "Failure!!!".'<br><hr><pre>'.$result.'<pre>';
                            $data['bool'] = false;
                     }
        $data['isCompare'] = false;
        $data['isFeature']= true;
        $this->load->view('view_results',$data);
        
    }
    public function checkDifference(){
      
        $images = directory_map('./application/img');
        $data['images']= $images;
        $data['isCompare']= false;
        $data['baseBrowser'] = $this->session->userdata('baseBrowser');
        $data['testBrowsers'] = implode(" , ",$this->session->userdata('testBrowsers'));
        $data['baseServer'] = $this->session->userdata('baseServer');
        $data['testServer'] = $this->session->userdata('testServer');
        $this->load->view('view_difference',$data);
    }
    public function checkDifferenceSC(){
        
        $images = directory_map('./application/screenshotCompare');
        $data['images']= $images;
        $data['isCompare']= true;
        $data['baseBrowserSC'] = $this->session->userdata('baseBrowserSC');
        $data['testBrowsersSC'] = $this->session->userdata('testBrowsersSC');
        $data['baseServerSC'] = $this->session->userdata('baseServerSC');
        $data['testServerSC'] = $this->session->userdata('testServerSC');
        $this->load->view('view_differenceSC',$data);
    }
    public function getBrowsers(){

        $dirFeatur = '../../../altests/';

        return explode("\n",fread(fopen($dirFeatur.'browsers',"r"),  filesize($dirFeatur.'browsers')));
    }
    public function testBaseFeature(){

         $browser = $_POST['browserval'];
         $this->session->set_userdata('baseBrowser', $browser);
          $isEdit = $_POST['isEdit2'];
          if($isEdit == "true"){

               $contents = $_POST['featuretextarea2'];
               file_put_contents('../../../altests/features/getBase.feature', $contents);
               $resource = fopen("../../../altests/features/compare.feature", "r");
               $testFeature = fread($resource, filesize("../../../altests/features/compare.feature"));
               $data['testFeature'] = $testFeature;


          }

        $result = "Not set yet";
        $server = $_POST['serverval'];
        $this->session->set_userdata('baseServer', $server);
        $setServer = $this->getServerURL($server);
        $command = 'cd ../../../altests &&'.$setServer.'&& behat -p \''.$browser.'\' --tags \'@getBase\'';
        
        $result = shell_exec($command);
        $data['browser'] = $browser;
        $data['command'] = $command;
        if($result == ""){
            $data['result'] = "Failure!!! returned empty check command line. Probably some exception";
            $data['bool'] = false;
        }
        else if(strpos($result,'You can implement step definitions for undefined steps with these snippets:')== TRUE){
                    $data['result'] = "Failure!!! returned empty check command line , Check your feature file";
                    $data['bool'] = false;
              }
             else if(strpos($result,'No scenarios')== TRUE){
                         $data['result'] = "Failure!!! returned empty check command line , Check your tags of feature file or probably feature file is empty";
                         $data['bool'] = false;
                   }
                   else if(strpos($result, 'failed')== FALSE ){
                                $data['result'] = "Success<br><hr><pre>".$result."</pre>";
                                $data['bool'] = true;
                   }
                        else {
                                $data['result'] = "Failure!!!".'<br><hr><pre>'.$result.'<pre>';
                                $data['bool'] = false;
                              }
    
        $data['browsers'] = $this->getBrowsers();
        $data['isEdit'] = $isEdit;
        $this->load->view('view_compareBrowser',$data);
       
    }

    public function compareBrowsers(){

        $selBrowsers =  $_POST['selBrowsers'];
        $isEdit = $_POST['isEdit2'];

        //echo "This is it ".$isEdit.$featureVal;
        if($isEdit == 'true'){
            $contents = $_POST['featureVal'];
            file_put_contents('../../../altests/features/compare.feature', $contents);
        }
        $this->session->set_userdata('testBrowsers', $selBrowsers);
        $server= $_POST['serverval'];
         $this->session->set_userdata('testServer', $server);
        $setServer = $this->getServerURL($server);
        $output = "Result of all test is \n";
        $data['bool'] = true;
        foreach ($selBrowsers as $browser) {
            $command = 'cd ../../../altests &&'.$setServer.' &&behat -p \''.$browser.'\' --tags \'@compare\'';
            $result = shell_exec($command);
            if(strpos($result, 'failed')== TRUE ){
                $output = "Something went wrong with ".$command;
                 $data['bool'] = false;
                    break;
            }
           $output .= $command." is success \n";
        }
        $data['result']=$output." <pre>".$result."</pre>";
       
        $data['command']="Demo";
        $data['isCompare']= false;
         $data['isFeature']= false;
        $this->load->view('view_results',$data);
    }
     public function testBaseFeatureForSC(){

           $browser = $_POST['browserval'];
           $this->session->set_userdata('baseBrowserSC', $browser);
          
           $isEdit = $_POST['isEdit1'];
           $server = $_POST['servervalSC'];
            $this->session->set_userdata('baseServerSC', $server);
          if($isEdit == "true"){           
               $contents = $_POST['featuretextarea1'];
               file_put_contents('../../../altests/features/screenshotFeature.feature', $contents);
               $resource = fopen("../../../altests/features/screenshotFeatureTest.feature", "r");
               $testFeature = fread($resource, filesize("../../../altests/features/screenshotFeatureTest.feature"));
               $data['testFeature'] = $testFeature;
       
          }
        $result = "Not set yet";
        $serveSet = $this->getServerURL($server);
        $command = 'cd ../../../altests &&'.$serveSet.'&&behat -p \''.$browser.'\' --tags \'@getScreenshotBase\'';

        $result = shell_exec($command);
        $data['browser'] = $browser;
        $data['command'] = $command;

        if($result == ""){
            $data['result'] = "Failure!!! returned empty check command line";
            $data['bool'] = false;
        }
        else if(strpos($result,'You can implement step definitions for undefined steps with these snippets:')== TRUE){
                    $data['result'] = "Failure!!! returned empty check command line , Check your feature file";
                    $data['bool'] = false;
              }
             else if(strpos($result,'No scenarios')== TRUE){
                          $data['result'] = "Failure!!! returned empty check command line , Check your tags of feature file or probably feature file is empty";
                          $data['bool'] = false;

                     }
                   else  if(strpos($result, 'failed')== FALSE ){
                                    $data['result'] = "Success<br><hr><pre>".$result."</pre>";
                                    $data['bool'] = true;
                             }
                           else {
                                    $data['result'] = "Failure!!!".'<br><hr><pre>'.$result.'<pre>';
                                    $data['bool'] = false;
                              }
        
        $data['browsers'] = $this->getBrowsers();
        $data['isEdit'] = $isEdit;
        $this->load->view('view_compareBrowserSC',$data);
    }
     public function compareBrowsersSC(){
       
        $selBrowsers =  $_POST['selBrowsers'];
        $isEdit = $_POST['isEdit2'];
       
        //echo "This is it ".$isEdit.$featureVal;
        if($isEdit == 'true'){
            $contents = $_POST['featureVal'];
            file_put_contents('../../../altests/features/screenshotFeatureTest.feature', $contents);
        }
        $this->session->set_userdata('testBrowsersSC', $selBrowsers);
        $server = $_POST['serverval'];
         $this->session->set_userdata('testServerSC', $server);
        $setServer = $this->getServerURL($server);
        $output = "Result of all test is \n";
         $data['bool'] = true;
        
            $command = 'cd ../../../altests &&'.$setServer.' &&behat -p \''.$selBrowsers.'\' --tags \'@getScreenshotTest\'';
            $result = shell_exec($command);
            if(strpos($result, 'failed')== TRUE ){
                $output = "Something went wrong with ".$command;
                 $data['bool'] = false;
                    
            }
            else
           $output .= $command." is success \n";
        
        $data['result']=$output." <pre>".$result."</pre>";
       
        $data['command']=$command;
        $data['isCompare'] = true;
         $data['isFeature']= false;
         $this->load->view('view_results',$data);
    }

    public function changefeature(){

        $contents = $_POST['featuretextarea'];
       
        
       file_put_contents('../../../altests/features/screenshotFeature.feature', $contents);
        $this->index();

    }
    public function addBrowser(){

        $this->index();
    }
    public function getServerURL($server){

        switch ($server) {
            case "Development":
                $url = "http://angiesmr2dev.prod.acquia-sites.com/";
                break;
            case "Production":
                $url = "http://angiesmr2.prod.acquia-sites.com/";
                break;
            case "Staging":
                $url = "http://angiesmr2stg.prod.acquia-sites.com/";
                break;
            default:
                break;
        }
        $setServer = " export BEHAT_PARAMS=\"extensions[Behat\MinkExtension\Extension][base_url]=".$url."\"";
        return $setServer;
    }
   
}

?>
