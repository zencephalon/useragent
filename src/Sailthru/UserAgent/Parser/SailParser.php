<?php

namespace Sailthru\UserAgent\Parser;

use Sailthru\UserAgent\ParserAbstract;

Class SailParser extends ParserAbstract
{

    /**
     * components of the useragent string
     * @var string
     */
    protected $platform;
    protected $os;
    protected $engine;
    protected $feature;
    protected $compatible;
    
    // browser and version
    protected $browser;
    protected $version;
    
    protected $mobile_browsers = array(
                'iPad', 'iPhone', 'Android', 'BlackBerry', 'Palm',
                'Windows Smartphone', 'Other Mobile'
              );

    public function __construct($ua = null)
    {
        if( empty($ua) ){
            $ua = $_SERVER['HTTP_USER_AGENT'];
        }

        parent::__construct($ua);
        $this->parse();
    }

    // get the browser info
    public function getBrowserInfo(\boolean $to_array)
    {
        
    }

    // get the browser
    public function getBrowser()
    {
        if( $this->ua ){
            $useragent = $this->ua;
        }
        else{
            $useragent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
        }
        $accept = isset($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : '';

        $useragent_uc = $useragent;
        
        $useragent = strtolower($useragent);

        // create a closure capturing $useragent so our code is more DRY --mkb
        $check_agent = function($match) use ($useragent) {
            return (strpos($useragent, $match) !== false);
        };
        
        $mobiles = array('1207'=>1,'3gso'=>1,'4thp'=>1,'501i'=>1,'502i'=>1,'503i'=>1,'504i'=>1,'505i'=>1,'506i'=>1,'6310'=>1,'6590'=>1,'770s'=>1,'802s'=>1,'a wa'=>1,'acer'=>1,'acs-'=>1,'airn'=>1,'alav'=>1,'asus'=>1,'attw'=>1,'au-m'=>1,'aur '=>1,'aus '=>1,'abac'=>1,'acoo'=>1,'aiko'=>1,'alco'=>1,'alca'=>1,'amoi'=>1,'anex'=>1,'anny'=>1,'anyw'=>1,'aptu'=>1,'arch'=>1,'argo'=>1,'bell'=>1,'bird'=>1,'bw-n'=>1,'bw-u'=>1,'beck'=>1,'benq'=>1,'bilb'=>1,'blac'=>1,'c55/'=>1,'cdm-'=>1,'chtm'=>1,'capi'=>1,'cond'=>1,'craw'=>1,'dall'=>1,'dbte'=>1,'dc-s'=>1,'dica'=>1,'ds-d'=>1,'ds12'=>1,'dait'=>1,'devi'=>1,'dmob'=>1,'doco'=>1,'dopo'=>1,'el49'=>1,'erk0'=>1,'esl8'=>1,'ez40'=>1,'ez60'=>1,'ez70'=>1,'ezos'=>1,'ezze'=>1,'elai'=>1,'emul'=>1,'eric'=>1,'ezwa'=>1,'fake'=>1,'fly-'=>1,'fly_'=>1,'g-mo'=>1,'g1 u'=>1,'g560'=>1,'gf-5'=>1,'grun'=>1,'gene'=>1,'go.w'=>1,'good'=>1,'grad'=>1,'hcit'=>1,'hd-m'=>1,'hd-p'=>1,'hd-t'=>1,'hei-'=>1,'hp i'=>1,'hpip'=>1,'hs-c'=>1,'htc '=>1,'htc-'=>1,'htca'=>1,'htcg'=>1,'htcp'=>1,'htcs'=>1,'htct'=>1,'htc_'=>1,'haie'=>1,'hita'=>1,'huaw'=>1,'hutc'=>1,'i-20'=>1,'i-go'=>1,'i-ma'=>1,'i230'=>1,'iac'=>'iac','iac-'=>1,'iac/'=>1,'ig01'=>1,'im1k'=>1,'inno'=>1,'iris'=>1,'jata'=>1,'java'=>1,'kddi'=>1,'kgt'=>'kgt','kgt/'=>1,'kpt '=>1,'kwc-'=>1,'klon'=>1,'lexi'=>1,'lg g'=>1,'lg-a'=>1,'lg-b'=>1,'lg-c'=>1,'lg-d'=>1,'lg-f'=>1,'lg-g'=>1,'lg-k'=>1,'lg-l'=>1,'lg-m'=>1,'lg-o'=>1,'lg-p'=>1,'lg-s'=>1,'lg-t'=>1,'lg-u'=>1,'lg-w'=>1,'lg/k'=>1,'lg/l'=>1,'lg/u'=>1,'lg50'=>1,'lg54'=>1,'lge-'=>1,'lge/'=>1,'lynx'=>1,'leno'=>1,'m1-w'=>1,'m3ga'=>1,'m50/'=>1,'maui'=>1,'mc01'=>1,'mc21'=>1,'mcca'=>1,'medi'=>1,'meri'=>1,'mio8'=>1,'mioa'=>1,'mo01'=>1,'mo02'=>1,'mode'=>1,'modo'=>1,'mot '=>1,'mot-'=>1,'mt50'=>1,'mtp1'=>1,'mtv '=>1,'mate'=>1,'maxo'=>1,'merc'=>1,'mits'=>1,'mobi'=>1,'motv'=>1,'mozz'=>1,'n100'=>1,'n101'=>1,'n102'=>1,'n202'=>1,'n203'=>1,'n300'=>1,'n302'=>1,'n500'=>1,'n502'=>1,'n505'=>1,'n700'=>1,'n701'=>1,'n710'=>1,'nec-'=>1,'nem-'=>1,'newg'=>1,'neon'=>1,'netf'=>1,'noki'=>1,'nzph'=>1,'o2 x'=>1,'o2-x'=>1,'opwv'=>1,'owg1'=>1,'opti'=>1,'oran'=>1,'p800'=>1,'pand'=>1,'pg-1'=>1,'pg-2'=>1,'pg-3'=>1,'pg-6'=>1,'pg-8'=>1,'pg-c'=>1,'pg13'=>1,'phil'=>1,'pn-2'=>1,'pt-g'=>1,'palm'=>1,'pana'=>1,'pire'=>1,'pock'=>1,'pose'=>1,'psio'=>1,'qa-a'=>1,'qc-2'=>1,'qc-3'=>1,'qc-5'=>1,'qc-7'=>1,'qc07'=>1,'qc12'=>1,'qc21'=>1,'qc32'=>1,'qc60'=>1,'qci-'=>1,'qwap'=>1,'qtek'=>1,'r380'=>1,'r600'=>1,'raks'=>1,'rim9'=>1,'rove'=>1,'s55/'=>1,'sage'=>1,'sams'=>1,'sc01'=>1,'sch-'=>1,'scp-'=>1,'sdk/'=>1,'se47'=>1,'sec-'=>1,'sec0'=>1,'sec1'=>1,'semc'=>1,'sgh-'=>1,'shar'=>1,'sie-'=>1,'sk-0'=>1,'sl45'=>1,'slid'=>1,'smb3'=>1,'smt5'=>1,'sp01'=>1,'sph-'=>1,'spv '=>1,'spv-'=>1,'sy01'=>1,'samm'=>1,'sany'=>1,'sava'=>1,'scoo'=>1,'send'=>1,'siem'=>1,'smar'=>1,'smit'=>1,'soft'=>1,'sony'=>1,'t-mo'=>1,'t218'=>1,'t250'=>1,'t600'=>1,'t610'=>1,'t618'=>1,'tcl-'=>1,'tdg-'=>1,'telm'=>1,'tim-'=>1,'ts70'=>1,'tsm-'=>1,'tsm3'=>1,'tsm5'=>1,'tx-9'=>1,'tagt'=>1,'talk'=>1,'teli'=>1,'topl'=>1,'hiba'=>1,'up.b'=>1,'upg1'=>1,'utst'=>1,'v400'=>1,'v750'=>1,'veri'=>1,'vk-v'=>1,'vk40'=>1,'vk50'=>1,'vk52'=>1,'vk53'=>1,'vm40'=>1,'vx98'=>1,'virg'=>1,'vite'=>1,'voda'=>1,'vulc'=>1,'w3c '=>1,'w3c-'=>1,'wapj'=>1,'wapp'=>1,'wapu'=>1,'wapm'=>1,'wig '=>1,'wapi'=>1,'wapr'=>1,'wapv'=>1,'wapy'=>1,'wapa'=>1,'waps'=>1,'wapt'=>1,'winc'=>1,'winw'=>1,'wonu'=>1,'x700'=>1,'xda2'=>1,'xdag'=>1,'yas-'=>1,'your'=>1,'zte-'=>1,'zeto'=>1,'acs-'=>1,'alav'=>1,'alca'=>1,'amoi'=>1,'aste'=>1,'audi'=>1,'avan'=>1,'benq'=>1,'bird'=>1,'blac'=>1,'blaz'=>1,'brew'=>1,'brvw'=>1,'bumb'=>1,'ccwa'=>1,'cell'=>1,'cldc'=>1,'cmd-'=>1,'dang'=>1,'doco'=>1,'eml2'=>1,'eric'=>1,'fetc'=>1,'hipt'=>1,'http'=>1,'ibro'=>1,'idea'=>1,'ikom'=>1,'inno'=>1,'ipaq'=>1,'jbro'=>1,'jemu'=>1,'java'=>1,'jigs'=>1,'kddi'=>1,'keji'=>1,'kyoc'=>1,'kyok'=>1,'leno'=>1,'lg-c'=>1,'lg-d'=>1,'lg-g'=>1,'lge-'=>1,'libw'=>1,'m-cr'=>1,'maui'=>1,'maxo'=>1,'midp'=>1,'mits'=>1,'mmef'=>1,'mobi'=>1,'mot-'=>1,'moto'=>1,'mwbp'=>1,'mywa'=>1,'nec-'=>1,'newt'=>1,'nok6'=>1,'noki'=>1,'o2im'=>1,'opwv'=>1,'palm'=>1,'pana'=>1,'pant'=>1,'pdxg'=>1,'phil'=>1,'play'=>1,'pluc'=>1,'port'=>1,'prox'=>1,'qtek'=>1,'qwap'=>1,'rozo'=>1,'sage'=>1,'sama'=>1,'sams'=>1,'sany'=>1,'sch-'=>1,'sec-'=>1,'send'=>1,'seri'=>1,'sgh-'=>1,'shar'=>1,'sie-'=>1,'siem'=>1,'smal'=>1,'smar'=>1,'sony'=>1,'sph-'=>1,'symb'=>1,'t-mo'=>1,'teli'=>1,'tim-'=>1,'tosh'=>1,'treo'=>1,'tsm-'=>1,'upg1'=>1,'upsi'=>1,'vk-v'=>1,'voda'=>1,'vx52'=>1,'vx53'=>1,'vx60'=>1,'vx61'=>1,'vx70'=>1,'vx80'=>1,'vx81'=>1,'vx83'=>1,'vx85'=>1,'wap-'=>1,'wapa'=>1,'wapi'=>1,'wapp'=>1,'wapr'=>1,'webc'=>1,'whit'=>1,'winw'=>1,'wmlb'=>1,'xda-'=>1);    
                
        if ($check_agent('ipad')) {
            return 'iPad';
        } else if ($check_agent('iphone') || $check_agent('ipod')) {
            return 'iPhone';
        } else if ($check_agent('android') && $check_agent('chrome') && $check_agent('mobile')) {
            return 'Android Tablet';
        } else if ($check_agent('android')) {
            return 'Android';
        } else if ($check_agent('opera mini')) {
            return 'Opera Mini';
        } else if ($check_agent('blackberry')) {
            return 'BlackBerry';
        } else if (preg_match('/(pre\/|palm os|palm|hiptop|avantgo|fennec|plucker|xiino|blazer|elaine)/', $useragent)) {
            return 'Palm';
        } else if (preg_match('/(iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile)/', $useragent)) {
            return 'Windows Smartphone';
        } else if (preg_match('/(mini 9.5|vx1000|lge |m800|e860|u940|ux840|compal|wireless| mobi|ahong|lg380|lgku|lgu900|lg210|lg47|lg920|lg840|lg370|sam-r|mg50|s55|g83|t66|vx400|mk99|d615|d763|el370|sl900|mp500|samu3|samu4|vx10|xda_|samu5|samu6|samu7|samu9|a615|b832|m881|s920|n210|s700|c-810|_h797|mob-x|sk16d|848b|mowser|s580|r800|471x|v120|rim8|c500foma:|160x|x160|480x|x640|t503|w839|i250|sprint|w398samr810|m5252|c7100|mt126|x225|s5330|s820|htil-g1|fly v71|s302|-x113|novarra|k610i|-three|8325rc|8352rc|sanyo|vx54|c888|nx250|n120|mtk |c5588|s710|t880|c5005|i;458x|p404i|s210|c5100|teleca|s940|c500|s590|foma|samsu|vx8|vx9|a1000|_mms|myx|a700|gu1100|bc831|e300|ems100|me701|me702m-three|sd588|s800|8325rc|ac831|mw200|brew |d88|htc\/|htc_touch|355x|m50|km100|d736|p-9521|telco|sl74|ktouch|m4u\/|me702|8325rc|kddi|phone|lg |sonyericsson|samsung|240x|x320vx10|nokia|sony cmd|motorola|up.browser|up.link|mmp|symbian|smartphone|midp|wap|vodafone|o2|pocket|mobile|psp|treo)/', $useragent)) {
            return 'Other Mobile';
        } else if (strpos($accept, 'text/vnd.wap.xml') !== false || strpos($accept, 'application/vnd.wap.xhtml+xml') !== false) {
            return 'Other Mobile';
        } else if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
            return 'Other Mobile';
        } else if (isset($mobiles[substr($useragent, 0, 4)])) {
            return 'Other Mobile';
        } else if ($check_agent('firefox')) {
            return 'Firefox';
        } else if ($check_agent('chrome')) {
            return 'Chrome';
        } else if ($check_agent('safari')) {
            return 'Safari';
        } else if ($check_agent('opera')) {
            return 'Opera';
        } else if ($check_agent('outlook')) {
            return 'Microsoft Outlook';
        } else if ($check_agent('msie')) {
            return 'Internet Explorer';
        } else if ($check_agent('kindle')) {
            return 'Kindle';
        }
        else {
            // log this so we can keep an eye on our top "other" useragents
//            Db::upsert('useragent.other', array('useragent' => $useragent_uc), array('$inc' => array('n' => 1)));
            return 'Other';
        }
    }

    // get the version
    public function getVersion()
    {

   	    $u_agent = $this->ua; 
	    $version = "";
            $ub = null;
	
	    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
	        $ub = "MSIE"; 
	    }

	    $known = array('Version', $ub, 'other');
	    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	    
		if (!preg_match_all($pattern, $u_agent, $matches)) {}
	
	    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) { 
	        $ub = "MSIE"; 
	    }

	    $known = array('Version', $ub, 'other');
	    $pattern = '#(?<browser>' . join('|', $known) . ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	    
		if (!preg_match_all($pattern, $u_agent, $matches)) {}

	    $i = count($matches['browser']);
	    if ($i != 1) {
	        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
	            $version= $matches['version'][0];
	        }
	        else {
	            $version= $matches['version'][1];
	        }
	    }
	    else {
	        $version= $matches['version'][0];
	    }
	    if ($version==null || $version=="") {$version="?";}
            
            return $version;

    }

    // get the Operating System
    public function getOS()
    {
        return $this->os;
    }

    // get the device (ipad,iphone)
    public function getPlatform()
    {
        $this->parse();
        return $this->platform;
    }

    // return true if is mobile
    public function isMobile(){
        $browser = $this->getBrowser();
        return in_array($browser, $this->mobile_browsers);
    }

    // parse the ua string
    protected function parse()
    {

    }

    protected function parsePlatform()
    {

        // already parsed
        if ($this->browser) {
            return;
        }

        list($this->browser, $this->version) = explode("/", $this->platform);
    }
}
